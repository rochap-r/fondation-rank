<?php

namespace App\Livewire\Admin\Ui\Abouts;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\About as ModelsAbout;
use Illuminate\Support\Facades\Storage;

class About extends Component
{
    use WithPagination;
    public $perpage=16;
    public $orderBy='desc';
    public $search=null;

    public $aboutRead=null;

    protected $listeners=[
        'resetForm',
        'deleteAboutAction'
    ];

    public function mount()
    {
        $this->resetPage();
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        //dd(Evenement::find(1)->image);
        return view('livewire.admin.ui.abouts.about',[
            'abouts'=>ModelsAbout::search(trim($this->search))
                ->when($this->orderBy,function ($query){
                    $query->orderBy('id',$this->orderBy);
                })
                ->paginate($this->perpage),
        ]);
    }

    public function deleteAbout(int $id)
    {
        $about=ModelsAbout::find($id);
        
        //lancement de la boite de confirmation
        $this->dispatch('deleteAbout',[
            'title'=>'Etes-vous vraiment sure de supprimer cette rubrique?',
            'html'=>"Suppression de la Rubrique: ".$about->title,
            'id'=>$about->id

        ]);
    }

    public function deleteAboutAction(int $id)
    {
        $about=ModelsAbout::find($id);
        //dd($event);
        $folder = 'abouts/';
        $thumbnail_path=$folder.'thumbnails/';
        //suppression des anciennes images
        $deleteResized=$thumbnail_path.'resized_'.$about->image->name;
        $deleteThumb=$thumbnail_path.'thumb_'.$about->image->name;
        $deletePath=$folder.$about->image->name;

        if (Storage::disk('public')->exists($deleteResized)) {
            Storage::disk('public')->delete($deleteResized);
        }
        if (Storage::disk('public')->exists($deleteThumb)) {
            Storage::disk('public')->delete($deleteThumb);
        }
        if (Storage::disk('public')->exists($deletePath)) {
            Storage::disk('public')->delete($deletePath);
        }
        $about->delete();
        $this->showToastr("la rubrique été supprimée avec succès.", 'info');
    }

    private function showToastr(string $message, string $type)
    {
        return $this->dispatch('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }

    
    public function resetForm()
    {
        $this->aboutRead=null;
        $this->resetErrorBag();

    }
    public function readAbout(ModelsAbout $about)
    {
        $this->aboutRead=$about;
        $this->resetErrorBag();
        $this->dispatch('showReadAbout');
    }

}
