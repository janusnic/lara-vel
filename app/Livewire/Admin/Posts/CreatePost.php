<?php

namespace App\Livewire\Admin\Posts;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;

use App\Livewire\Forms\PostForm;
use App\Models\{Post, User, Tag};
use App\Enums\PostStatus;

#[Title('Create Post')]
class CreatePost extends Component
{

    use WithFileUploads;
    
    public Array $users;
    public Array $tags;
    public Array $postStatus;

    // #[Validate('required|min:3')]
	// public $title = '';
 
	// #[Validate('required|min:3')]
	// public $content = '';

    // #[Validate('required|min:3', onUpdate: false)]
    // public $title = '';
 
    // #[Validate('required|min:3', onUpdate: false)]
    // public $content = '';

    public PostForm $form;
 
    // public function save()
    // {
    //     $validated = $this->validate([ 
    //         'title' => 'required|min:3',
    //         'content' => 'required|min:3',
    //     ]);
 
    //     Post::create($validated);
 
    //     return redirect()->to('/admin/posts');
    // }

    public function mount(): void
    {
        $this->tags = Tag::all('id', 'name')->toArray();
        $this->users = User::all('id', 'name')->toArray();
        $this->postStatus = PostStatus::options();
    }
    
    public function save()
    {
        $this->form->store(); 
        return $this->redirect('/admin/posts');
    }

    // public function save()
	// {
    // 	Post::create(
    //     	$this->form->all()
    // 	);
    //     return redirect()->to('/admin/posts');
    // }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.posts.create-post');
    }
}



