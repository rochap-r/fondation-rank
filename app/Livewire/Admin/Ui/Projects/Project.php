<?php

namespace App\Livewire\Admin\Ui\Projects;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use App\Models\Project as ModelsProject;

class Project extends Component
{
    use WithPagination;
    public $perpage=12;
    public $orderBy='desc';
    public $search=null;
    public $type=null;
    public $projet=null;
    public $author=null;
    protected $listeners=[
        'resetForm',
        'deleteProjectAction'
    ];


    public function mount()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingType()
    {
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->projet=null;

    }
    
    public function render()
    {
        return view('livewire.admin.ui.projects.project',[
            'projects'=>ModelsProject::search(trim($this->search))
                ->when($this->type,function ($query){
                    $query->where('type_project_id',$this->type);
                })
                ->when($this->orderBy,function ($query){
                    $query->orderBy('id',$this->orderBy);
                })
                ->paginate($this->perpage),
        ]);
    }

    public function readProject(int $id)
    {
        //dd($id);
        $project=ModelsProject::findOrFail( $id);
        $this->projet=$project;
        $this->resetErrorBag();
        $this->dispatch('showReadProject');
    }

    public function deleteProjectAction(int $id)
    {
        $project=ModelsProject::find($id);
        $folder = 'projects/';
        $thumbnail_path=$folder.'thumbnails/';
        //suppression des anciennes images
        $deleteResized=$thumbnail_path.'resized_'.$project->image->name;
        $deleteThumb=$thumbnail_path.'thumb_'.$project->image->name;
        $deletePath=$folder.$project->image->name;

        if (Storage::disk('public')->exists($deleteResized)) {
            Storage::disk('public')->delete($deleteResized);
        }
        if (Storage::disk('public')->exists($deleteThumb)) {
            Storage::disk('public')->delete($deleteThumb);
        }
        if (Storage::disk('public')->exists($deletePath)) {
            Storage::disk('public')->delete($deletePath);
        }
        $project->delete();
        $this->showToastr("le projet a été supprimé avec succès.", 'info');
    }

    public function deleteProject(int $id)
    {
        $project=ModelsProject::find($id);
        //lancement de la boite de confirmation
        $this->dispatch('deleteProject',[
            'title'=>'Etes-vous vraiment sure de supprimer ce projet?',
            'html'=>"Suppression du Projet: ".$project->title,
            'id'=>$project->id

        ]);
    }

    private function showToastr(string $message, string $type)
    {
        return $this->dispatch('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }
}
