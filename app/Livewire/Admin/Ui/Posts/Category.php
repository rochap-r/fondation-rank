<?php

namespace App\Livewire\Admin\Ui\Posts;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category as ModelsCategory;

class Category extends Component
{

    
    use WithPagination;
    public $name;
    public $selected_id;

    public $perPage = 8;
    public $updateCategoryMode=false;

    public function mount()
    {
        $this->resetPage();
    }

    //ecouteur de réunitialisation du form dans le modal sur index de categories
    protected $listeners=[
        'resetForm',
        'deleteCategoryAction'
    ];

    //cette function communique l'ecouteur
    public function resetForm()
    {
        $this->resetErrorBag();
        $this->updateCategoryMode=false;
        $this->name=null;

    }
    public function addCategory()
    {
        $this->validate([
            'name'=>'required|unique:categories,name',
        ], [
            'name.required'=>'le nom de la catégorie est obligatoire',
            'name.unique'=>'Cette catégorie existe déjà veuillez réessayez un autre nom!'
        ]);
        $category=new ModelsCategory();
        $category->name=$this->name;
        $result=$category->save();
        if ($result){
            $this->dispatch('hideCategoryModal');
            $this->name=null;
            $this->showToastr('Une nouvelle Catégorie d\'Article a  été créé avec succès!','success');
        }else{
            $this->showToastr('Oups! Quelquechose n\'a pas bien fonctionné!','error');
        }

    }

    public function editCategory(int $id)
    {
        $category=ModelsCategory::findOrFail( $id);
        $this->selected_id=$category->id;
        $this->name=$category->name;
        $this->updateCategoryMode=true;
        $this->resetErrorBag();
        $this->dispatch('showEditCategoryModal');
    }

    public function updateCategory()
    {
        if ($this->selected_id){
            $this->validate([
                'name'=>'required|unique:categories,name,'.$this->selected_id,
            ], [
                'name.required'=>'ce champs est obligatoire',
                'name.unique'=>'Cette Catégorie existe déjà veuillez réessayez une autre!'
            ]);

            $category=ModelsCategory::findOrFail($this->selected_id);
            $category->name=$this->name;
            $result=$category->save();
            if ($result){
                $this->dispatch('hideCategoryModal');
                $this->updateCategoryMode=false;
                $this->name=null;
                $this->showToastr('Une Catégorie d\'Article a bien été mis à jour!','success');
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


    public function deleteCategoryAction(int $id)
    {
        
        $category=ModelsCategory::find($id);
        if ($category){
            $category->delete();
            $this->showToastr("la catégorie a été supprimée avec succès.", 'info');
        }else{
            $this->showToastr("Il est impossible de supprimer cet type, qui est configuré par defaut.", 'error');
        }

    }

    public function deleteCategory(int $id)
    {
        $category=ModelsCategory::find($id);
        $this->dispatch('deleteCategory',[
            'title'=>'Etes-vous vraiment sûre de supprimer cette Catégorie?',
            'html'=>"Suppression de la catégorie: ".$category->name,
            'id'=>$category->id

        ]);
    }

    public function render()
    {
        return view('livewire.admin.ui.posts.category',[
            'categories'=>ModelsCategory::latest()->orderBy('id','asc')->withCount('posts')->paginate($this->perPage),
        ]);
    }
}
