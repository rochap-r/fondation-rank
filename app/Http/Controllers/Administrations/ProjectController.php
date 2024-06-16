<?php

namespace App\Http\Controllers\Administrations;

use App\Models\Project;
use App\Services\Images;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public $rules = [
        'title' => 'required|unique:projects',
        'description' => 'required',
        'type_project_id' => 'required',
        'goal' => 'required|numeric',
        'collected' => 'required|numeric',
        'image' => 'required|mimes:jpeg,jpg,png,webp|max:4100',
    ];

    public $messages = [
        'title.required' => 'Le titre du projet est obligatoire. Veuillez le saisir.',
        'title.unique' => 'Ce titre existe déjà. Veuillez saisir un autre titre.',
        'description.required' => 'La description du projet est obligatoire. Veuillez la saisir.',
        'goal.required' => 'L\'objectif du projet est obligatoire. Veuillez le saisir.',
        'goal.numeric' => 'L\'objectif du projet doit être un nombre.',
        'collected.required' => 'Le montant collecté est obligatoire. Veuillez le saisir.',
        'collected.numeric' => 'Le montant collecté doit être un nombre.',
        'category_id.required' => "Vous devez selection une catégorie.",
        'image.required' => "Veuillez choisir l'image du projet.",
        'image.mimes' => "JPG, JPEG, PNG et WEBP sont les formats d'images acceptés.",
        'image.max' => "la taille maximum de l'image est de 4100.",
        'type_project_id' => "Veuillez choisir un Type de projet.",
    ];


    public function add(Request $request)
    {
        $validated = $request->validate($this->rules, $this->messages);

        $project = Project::create($validated);
        $return = response()->json([
            'code' => 1, 'msg' => "Le projet a été créé avec succès!",
            'redirectUrl' => route('admin.project.index'),
        ]);

        if ($request->has('image')) {
            $folder = 'projects/';
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $new_file = time() . '_' . $filename;

            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }
            $upload = Storage::disk('public')->put($folder . $new_file, (string) file_get_contents($file));

            $thumbnail_path = $folder . 'thumbnails/';

            Images::ImageProcess($thumbnail_path, $folder, $new_file);

            if ($upload) {
                $fileName = $new_file;
                $extension = $file->getClientOriginalExtension();
                $result = $project->image()->create([
                    'name' => $fileName,
                    'extension' => $extension,
                    'path' => $upload,
                ]);
                if ($result) {
                    $return = response()->json([
                        'code' => 1, 'msg' => "Le projet a été créé avec succès!",
                        'redirectUrl' => route('admin.project.index'),
                    ]);
                } else {
                    $return = response()->json(['code' => 3, 'msg' => "Oups! Désolé Quelque chose n'a pas bien fonctionné, réessayez!"]);
                }
            } else {
                $return = response()->json(['code' => 3, 'msg' => "Oups! Quelque chose n'a pas bien fonctionné, réessayez!"]);
            }
        }
        return $return;
    }


    public function update(Request $request, Project $project): \Illuminate\Http\JsonResponse
    {
        $rules = [
            'title' => 'required|unique:projects,title,' . $project->id,
            'description' => 'required',
            'goal' => 'required',
            'collected' => 'required',
            'type_project_id' => 'required',
        ];

        $validated = $request->validate($rules);

        $project->update($validated);
        $return = response()->json([
            'code' => 1,
            'msg' => "Le projet a été mis à jour avec succès!",
            'description' => $project->description,
            'redirectUrl' => route('admin.project.index'),
        ]);

        if ($request->has('image')) {
            $folder = 'projects/';
            $thumbnail_path = $folder . 'thumbnails/';
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $new_file = time() . '_' . $filename;

            // Suppression des anciennes images
            $deleteResized = $thumbnail_path . 'resized_' . $project->image->name;
            $deleteThumb = $thumbnail_path . 'thumb_' . $project->image->name;
            $deletePath = $folder . $project->image->name;

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

            Images::ImageProcess($thumbnail_path, $folder, $new_file);

            if ($upload) {
                $fileName = $new_file;
                $extension = $file->getClientOriginalExtension();
                $result = $project->image()->update([
                    'name' => $fileName,
                    'extension' => $extension,
                    'path' => $upload,
                ]);
                if ($result) {
                    $return = response()->json([
                        'code' => 1,
                        'msg' => "Le projet a été mis à jour avec succès!",
                        'description' => $project->description,
                        'redirectUrl' => route('admin.project.index'),
                    ]);
                } else {
                    $return = response()->json(['code' => 3, 'msg' => "Oups! Désolé Quelque chose n'a pas bien fonctionné, réessayez!"]);
                }
            } else {
                $return = response()->json(['code' => 3, 'msg' => "Oups! Quelque chose n'a pas bien fonctionné, réessayez!"]);
            }
        }
        return $return;
    }



    public function create()
    {
        return view('administration.ui.projects.create');
    }

    public function edit(string $slug)
    {
        $project = Project::where('slug', $slug)->first();
        if (!$project) {
            return abort(404);
        }
        //dd($project->category);
        return view('administration.ui.projects.edit', [
            'project' => $project
        ]);
    }

    public function index()
    {
        return view('administration.ui.projects.index');
    }
}
