<?php

namespace App\Livewire\Admin\Ui\Projects;

use App\Models\TypeProject;
use Livewire\Component;
use Livewire\WithPagination;

class Type extends Component
{

    use WithPagination;
    public $name;
    public $selected_id;

    public $perPage = 8;
    public $updateTypeMode=false;

    public function mount()
    {
        $this->resetPage();
    }

    //ecouteur de réunitialisation du form dans le modal sur index de categories
    protected $listeners=[
        'resetForm',
        'deleteTypeAction'
    ];

    //cette function communique l'ecouteur
    public function resetForm()
    {
        $this->resetErrorBag();
        $this->updateTypeMode=false;
        $this->name=null;

    }
    public function addType()
    {
        $this->validate([
            'name'=>'required|unique:type_projects,name',
        ], [
            'name.required'=>'le nom du type des projets est obligatoire',
            'name.unique'=>'Ce Type existe déjà veuillez réessayez un autre nom!'
        ]);
        $type=new TypeProject();
        $type->name=$this->name;
        $result=$type->save();
        if ($result){
            $this->dispatch('hideTypeModal');
            $this->name=null;
            $this->showToastr('Un nouvel Type de Projet a  été créé avec succès!','success');
        }else{
            $this->showToastr('Oups! Quelquechose n\'a pas bien fonctionné!','error');
        }

    }

    public function editType(int $id)
    {
        $type=TypeProject::findOrFail( $id);
        $this->selected_id=$type->id;
        $this->name=$type->name;
        $this->updateTypeMode=true;
        $this->resetErrorBag();
        $this->dispatch('showEditTypeModal');
    }

    public function updateType()
    {
        if ($this->selected_id){
            $this->validate([
                'name'=>'required|unique:type_projects,name,'.$this->selected_id,
            ], [
                'name.required'=>'ce champs est obligatoire',
                'name.unique'=>'Ce Type existe déjà veuillez réessayez un autre nom!'
            ]);

            $type=TypeProject::findOrFail($this->selected_id);
            $type->name=$this->name;
            $result=$type->save();
            if ($result){
                $this->dispatch('hideTypeModal');
                $this->updateTypeMode=false;
                $this->name=null;
                $this->showToastr('Un Type de projet a bien été mis à jour!','success');
            }else{
                $this->showToastr('Oups! Quelquechose n\'a pas bien fonctionné!','error');
            }

        }
    }


    public function showToastr($message,$type){
        return $this->dispatch('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }


    public function deleteTypeAction(int $id)
    {
        
        $type=TypeProject::find($id);
        if ($type){
            $type->delete();
            $this->showToastr("le Type a été supprimé avec succès.", 'info');
        }else{
            $this->showToastr("Il est impossible de supprimer cet type, qui est configuré par defaut.", 'error');
        }

    }

    public function deleteType(int $id)
    {
        $type=TypeProject::find($id);
        $this->dispatch('deleteType',[
            'title'=>'Etes-vous vraiment sûre de supprimer ce type?',
            'html'=>"Suppression du type: ".$type->name,
            'id'=>$type->id

        ]);
    }

    public function render()
    {
        return view('livewire.admin.ui.projects.type',[
            'types'=>TypeProject::latest()->orderBy('id','asc')->withCount('projects')->paginate($this->perPage),
        ]);
    }
}
