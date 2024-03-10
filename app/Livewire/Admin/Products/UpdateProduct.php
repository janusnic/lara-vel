<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Livewire\Forms\ProductForm;
use Livewire\WithFileUploads;
use App\Models\{Product, Category, Brand};
use App\Enums\ProductStatus;

#[Title('Edit Product')]
class UpdateProduct extends Component
{
    use WithFileUploads;

    public ProductForm $form;
    public $categories;
    public $brands;
    public $productStatus;

    public function mount(Product $product)
    {
        $this->form->setProduct($product);
        $this->categories = Category::pluck('name', 'id');
        $this->brands = Brand::pluck('name', 'id');
        $this->productStatus = ProductStatus::options();
    }

    public function save()
    {
        $this->form->update();

        return $this->redirect('/admin/products');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.products.update-product');
    }
}
