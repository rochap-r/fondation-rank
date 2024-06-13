<?php

namespace App\Livewire\Admin\Ui\Posts;

use App\Models\Post as ModelsPost;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Post extends Component
{

    use WithPagination;
    public $postRead=null;
    public $perpage = 16;
    public $orderBy = 'desc';
    public $search = null;
    public $category = null;
    public $author = null;
    protected $listeners = [
        'resetForm',
        'deletePostAction',
    ];

    public function mount()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingCategory()
    {
        $this->resetPage();
    }
    public function updatingAuthor()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.ui.posts.post', [
            'posts' => ModelsPost::search(trim($this->search))
                ->when($this->category, function ($query) {
                    $query->where('category_id', $this->category);
                })
                ->when($this->author, function ($query) {
                    $query->where('user_id', $this->author);
                })
                ->when($this->orderBy, function ($query) {
                    $query->orderBy('id', $this->orderBy);
                })
                ->paginate($this->perpage),
        ]);
    }

    public function deletePostAction(int $id)
    {
        $post = ModelsPost::find($id);
        $folder = 'posts/';
        $thumbnail_path = $folder . 'thumbnails/';
        //suppression des anciennes images
        $deleteResized = $thumbnail_path . 'resized_' . $post->image->name;
        $deleteThumb = $thumbnail_path . 'thumb_' . $post->image->name;
        $deletePath = $folder . $post->image->name;

        if (Storage::disk('public')->exists($deleteResized)) {
            Storage::disk('public')->delete($deleteResized);
        }
        if (Storage::disk('public')->exists($deleteThumb)) {
            Storage::disk('public')->delete($deleteThumb);
        }
        if (Storage::disk('public')->exists($deletePath)) {
            Storage::disk('public')->delete($deletePath);
        }
        $post->delete();
        $this->showToastr("l'article a été supprimé avec succès.", 'info');
    }

    public function deletePost(int $id)
    {
        $post = ModelsPost::find($id);
        //lancement de la boite de confirmation
        $this->dispatch('deletePost', [
            'title' => 'Etes-vous vraiment sure de supprimer cet article?',
            'html' => "Suppression de l'Article: " . $post->title,
            'id' => $post->id

        ]);
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
        $this->postRead=null;
        $this->resetErrorBag();

    }
    public function readPost(ModelsPost $post)
    {
        $this->postRead=$post;
        $this->resetErrorBag();
        $this->dispatch('showReadPost');
    }
}
