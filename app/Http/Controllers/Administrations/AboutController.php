<?php

namespace App\Http\Controllers\Administrations;

use App\Services\Images;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public $rules = [
        'title' => 'required|unique:abouts,title,',
        'content' => 'required',
        'image' => 'required|mimes:jpeg,jpg,png,webp|max:4000',
    ];
    public $messages = [
        'title.required' => "le titre d'évenement est obligatoire veuillez le saisir.",
        'title.unique' => "Ce titre existe déjà veuillez saisir un autre.",
        'content.required' => "le contenu d'article est obligatoire veuillez le saisir.",
        'image.required' => "Veuillez choisir l'image d'article.",
        'image.mimes' => "JPG, JPEG, PNG et WEBP sont les formats d'images acceptés.",
        'image.max' => "la taille maximum de l'image est de 1024.",
    ];
    public function index()
    {
        return view('administration.ui.abouts.index');
    }


    public function create()
    {
        return view('administration.ui.abouts.create');
    }

    public function add(Request $request)
    {
        $validated = $request->validate($this->rules, $this->messages);
        if ($request->approved === null) {
            $validated['approved'] = 0;
        } else {
            $validated['approved'] = $request->approved !== null;
        }


        $about = About::create($validated);
        $return = response()->json([
            'code' => 1,
            'msg' => "La Rubrique d'apropos a été créé avec succès!",
            'redirectUrl' => route('admin.about.index'),
        ]);
        if ($request->has('image')) {
            $folder = 'abouts/';
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $new_file = time() . '_' . $filename;

            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }
            $upload = Storage::disk('public')->put($folder . $new_file, (string) file_get_contents($file));
            $thumbnail_path = $folder . 'thumbnails/';

            Images::ImageProcess($thumbnail_path, $folder, $new_file, true);

            if ($upload) {
                $fileName = $new_file;
                $extension = $file->getClientOriginalExtension();
                $result = $about->image()->create([
                    'name' => $fileName,
                    'extension' => $extension,
                    'path' => $upload,
                ]);
                if ($result) {
                    $return = response()->json(
                        [
                            'code' => 1,
                            'msg' => "La Rubrique d'apropos a été créé avec succès!",
                            'redirectUrl' => route('admin.about.index'),
                        ]
                    );
                } else {
                    $return = response()->json(['code' => 3, 'msg' => "Oups! Désolé Quelque chose n'a pas bien fonctionné, réessayez!"]);
                }
            } else {
                $return = response()->json(['code' => 3, 'msg' => "Oups! Quelque chose n'a pas bien fonctionné, réessayez!"]);
            }
        }
        return $return;
    }

    public function edit(string $slug)
    {
        $about = About::where('slug', $slug)->first();
        //dd($event);
        if (!$about) {
            return abort(404);
        }
        //dd($post->category);
        return view('administration.ui.abouts.edit', [
            'about' => $about
        ]);
    }

    public function update(Request $request, About $about): \Illuminate\Http\JsonResponse
    {
        //la maj de la photo n'est obligatoire

        $this->rules['image'] = 'nullable|file|mimes:jpeg,jpg,png,webp|max:1024';
        $this->rules['title'] = 'required|unique:abouts,title,' . $about->id;
        //dd($post);
        $validated = $request->validate($this->rules, $this->messages);
        if ($request->approved === null) {
            $validated['approved'] = 0;
        } else {
            $validated['approved'] = $request->approved !== null;
        }

        $about->update($validated);
        $return = response()->json(
            [
                'code' => 1,
                'msg' => "La Rubrique d'apropos a été mis à jour avec succès!",
                'content' => $about->content,
                'redirectUrl' => route('admin.about.index'),
            ]
        );

        if ($request->has('image')) {
            $folder = 'abouts/';
            $thumbnail_path = $folder . 'thumbnails/';
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $new_file = time() . '_' . $filename;

            //suppression des anciennes images
            $deleteResized = $thumbnail_path . 'resized_' . $about->image->name;
            $deleteThumb = $thumbnail_path . 'thumb_' . $about->image->name;
            $deletePath = $folder . $about->image->name;

            if (Storage::disk('public')->exists($deleteResized)) {
                Storage::disk('public')->delete($deleteResized);
            }
            if (Storage::disk('public')->exists($deleteThumb)) {
                Storage::disk('public')->delete($deleteThumb);
            }
            if (Storage::disk('public')->exists($deletePath)) {
                Storage::disk('public')->delete($deletePath);
            }

            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }
            $upload = Storage::disk('public')->put($folder . $new_file, (string) file_get_contents($file));


            Images::ImageProcess($thumbnail_path, $folder, $new_file, true);

            if ($upload) {
                $fileName = $new_file;
                $extension = $file->getClientOriginalExtension();
                $result = $about->image()->update([
                    'name' => $fileName,
                    'extension' => $extension,
                    'path' => $upload,
                ]);
                if ($result) {
                    $return = response()->json(
                        [
                            'code' => 1,
                            'msg' => "La Rubrique d'apropos a été mis à jour avec succès!",
                            'content' => $about->content,
                            'redirectUrl' => route('admin.event.index'),
                        ]
                    );
                } else {
                    $return = response()->json(['code' => 3, 'msg' => "Oups! Désolé Quelque chose n'a pas bien fonctionné, réessayez!"]);
                }
            } else {
                $return = response()->json(['code' => 3, 'msg' => "Oups! Quelque chose n'a pas bien fonctionné, réessayez!"]);
            }
        }
        return $return;
    }
}
