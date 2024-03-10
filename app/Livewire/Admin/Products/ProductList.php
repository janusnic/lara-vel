<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Products List')]
#[Layout('layouts.admin')]
class ProductList extends Component
{
   
    public function render()
    {
        return view('livewire.admin.products.product-list');
    }
}
