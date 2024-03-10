<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductForm extends Form
{
    public ?Product $product;

    // #[Validate('required|min:5')]
    public $name = '';

    // #[Validate('required')]
    public $price = 0;
 
    // #[Validate('required|min:5')]
    public $description = '';
    
    // #[Validate('required|integer')]
    public $status = 0;

    public $oldCover;

    // #[Validate('required|integer')]
    public $category_id;

    // #[Validate('required|integer')]
    public $brand_id;

    // #[Validate('required|image|max:1024')] // 1MB Max
    public $cover;

    public function rules()
	{
    	return [
        	'name' => [
            	'required',
                'min:5',
            	// Rule::unique('products')->ignore($this->product),
        	],
        	'description' => 'required|min:5',
            'price' => 'required',
            'status' => 'required|integer',
            'category_id' => 'required|integer',
            'brand_id' => 'required|integer',
    	];
	}

    public function setProduct(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->description = $product->description;
        $this->status = $product->status;
        $this->oldCover = $product->cover;
        $this->category_id = $product->category_id;
        $this->brand_id = $product->brand_id;
    }
 
    public function store() 
    {
        $validated = $this->validate();
        // dd($validated);
        $this->cover = $this->cover->store('products', 'public');
        Product::create($this->all());
        session()->flash('success','Product Created Successfully!');
    }

    public function update()
    {
        $validated = $this->validate();
        
        // dd($this->cover);

        if ($this->cover) {
            if ($this->cover->getClientOriginalName()) {
                // dd($this->oldCover);
                if ($this->oldCover !== null && Storage::disk('public')->exists($this->oldCover)) {
                    Storage::disk('public')->delete($this->oldCover);
                }
                
                $this->cover = $this->cover->store('products', 'public');
            }
        } else {
            $this->cover = $this->oldCover;
        }
        
        $this->product->update(
            $this->all()
        );

    	session()->flash('success','Product Updated Successfully!');

        $this->reset();
    }
}
