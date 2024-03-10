<?php

namespace App\Livewire\Admin\Posts;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Livewire\Forms\PostForm;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use App\Models\{Post, User, Tag};
use App\Enums\PostStatus;

#[Title('Edit Post')]
class UpdatePost extends Component
{
    use WithFileUploads;
    
    public Array $users;
    public Array $tags;
    public Array $postStatus;

    public PostForm $form;

    public function mount(Post $post)
    {
        // dd($post);
        $this->form->setPost($post);
        // dd($this->form);
        $this->tags = Tag::all('id', 'name')->toArray();
        $this->users = User::all('id', 'name')->toArray();
        $this->postStatus = PostStatus::options();
    }

    public function save()
    {
        $this->form->update();

        return $this->redirect('/admin/posts');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.posts.update-post');
    }
}
