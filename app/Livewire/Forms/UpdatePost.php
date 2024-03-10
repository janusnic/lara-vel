<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Validation\Rule;
use App\Models\Post;

class UpdatePost extends Form
{
    public ?Post $post;
 
	public $title = '';
 
	public $content = '';
 
	public function rules()
	{
    	return [
        	'title' => [
            	'required',
            	Rule::unique('posts')->ignore($this->post),
        	],
        	'content' => 'required|min:5',
    	];
	}
 
	public function mount()
	{
    	$this->title = $this->post->title;
    	$this->content = $this->post->content;
	}
 
	public function update()
	{
    	$this->validate();
    	$this->post->update($this->all());
    	$this->reset();
	}

}
