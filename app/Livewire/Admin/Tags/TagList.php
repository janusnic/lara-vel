<?php

namespace App\Livewire\Admin\Tags;

use Livewire\Component;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Tags List')]
#[Layout('layouts.admin')]
class TagList extends Component
{
    public function render()
    {
        return view('livewire.admin.tags.tag-list');
    }
}
