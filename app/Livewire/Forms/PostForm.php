<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostForm extends Form
{
	public ?Post $post;

    #[Validate('required|min:5')]
    public $title = '';

    #[Validate('required|min:5')]
    public $content = '';
    
    #[Validate('required|integer')]
    public $status = 0;

    #[Validate('required|array')]
    public array $tags = [];

    public $oldCover;

    #[Validate('required|integer')]
    public $user_id;

    #[Validate('image|nullable')] 
    public $cover;
    
    #[Validate('date|nullable')] 
    public $is_published;

    public function setPost(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->status = $post->status;
        $this->user_id = $post->user_id;
        $this->is_published = $post->is_published;
        // $this->is_published = \Carbon\Carbon::parse($post->is_published)->format('m / d / Y');
        
        $this->tags = $post->tags()->pluck('id')->toArray();
        $this->oldCover = $post->cover;
    }
 
    public function store() 
    {
        $validated = $this->validate();
        
        // dd($validated);
        $this->cover = $this->cover->store('posts', 'public');

        $post = Post::create($this->all());

        $post->tags()->sync($this->tags);
        session()->flash('success','Post Created Successfully!');
    }
   

    public function update()
    {
        $validated = $this->validate();
        // dd($validated);
        if ($this->cover) {

            if ($this->oldCover !== null && Storage::disk('public')->exists($this->oldCover)) {
                Storage::disk('public')->delete($this->oldCover);
            }
            $this->cover = $this->cover->store('posts', 'public');
         
        } else {
            $this->cover = $this->oldCover;
        }

        $this->post->update(
            $this->all()
        );
        $this->post->tags()->sync($this->tags);
        session()->flash('success','Post Updated Successfully!');
    }



}
