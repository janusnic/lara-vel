<?php

namespace App\Livewire\Admin\Posts;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Products List')]
#[Layout('layouts.admin')]
class PostList extends Component
{
    
    public function render()
    {
        return view('livewire.admin.posts.post-list');
    }
}
