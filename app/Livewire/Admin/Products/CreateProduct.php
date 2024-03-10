<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

use App\Livewire\Forms\ProductForm;
use Livewire\WithFileUploads;

use App\Models\{Category, Brand};
use App\Enums\ProductStatus;

#[Title('Create Product')]
class CreateProduct extends Component
{
    use WithFileUploads;
    
    public $categories;
    public $brands;
    public $productStatus;

    public ProductForm $form;

    public function mount(): void
    {
        $this->categories = Category::pluck('name', 'id');
        $this->brands = Brand::pluck('name', 'id');
        $this->productStatus = ProductStatus::options();
    }
    
    public function save()
    {
        $this->form->store(); 
        return $this->redirect('/admin/products');
    }

 
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.products.create-product');
    }
}
