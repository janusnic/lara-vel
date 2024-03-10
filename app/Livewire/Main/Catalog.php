<?php

namespace App\Livewire\Main;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

use App\Models\Product;
use App\Enums\ProductStatus;

use Livewire\WithPagination;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;

#[Title('Catalog page')]
#[Layout('layouts.main')]
class Catalog extends Component
{
    use WithPagination;

    public Collection $products;

    public $perPage = 6;
    public int $page = 1;

    public array $quantity = [];

    public Product $product;

    public function mount()
    {
        $this->products = collect();
        foreach ($this->products as $product){
            $this->quantity[$product->id] = 1;
        }
        $this->loadMore();
    }

    public function loadMore()
    {
        $this->products->push(
            ...$this->paginator->getCollection()
        );

        $this->page = $this->page + 1;
    }

    #[Computed()]
    public function paginator()
    {
        return Product::where('status',"!=", ProductStatus::PENDING())->with('category')->latest('updated_at')->paginate($this->perPage, ['*'], 'page', $this->page);
    }

    public function addToCart($id) {
        $this->product = Product::findOrFail($id);
        \Cart::add([
            'id' => $this->product->id,
            'name'=>$this->product->name,
            'price' => $this->product->price / 100,
            'quantity' => 1,
            'attributes' => [
                'image' => $this->product->cover,
            ]
            ]);
            
            $this->dispatch('refresh');
    }


    public function render()
    {

        // dd($this->products);
        return view('livewire.main.catalog');
    }
}
