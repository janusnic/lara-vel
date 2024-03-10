<?php

namespace App\Livewire\Main;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Shopping Cart')]
#[Layout('layouts.main')]
class ShoppingCart extends Component
{
    public $cartItems = [];
    public $tax = 0.07;

    protected $listeners = ['cartUpdated' => '$refresh'];

    public function remove($id)
    {
        \Cart::remove($id);
        $this->dispatch('cart_updated');
        session()->flash('success', 'Item has removed !');
    }

    public function clear()
    {
        \Cart::clear();
        session()->flash('success', 'All Item Cart Clear Successfully !');
        $this->dispatch('cart_updated');
    }

    public function render()
    {
        $this->cartItems = \Cart::getContent()->toArray();
        return view('livewire.main.shopping-cart');
    }
}
