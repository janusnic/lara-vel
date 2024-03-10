<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

class CategoryList extends Component
{
    #[Title('Categories List')]
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.categories.category-list');
    }
}
