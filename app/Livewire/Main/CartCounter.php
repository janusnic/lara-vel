<?php

namespace App\Livewire\Main;

use Livewire\Component;

class CartCounter extends Component
{
    protected $listeners = ['cart_updated'=>'render'];
    
    public int $cart_count;

    public function mount()
    {
        $this->cart_count = \Cart::getContent()->count();
    }
    

    public function render()
    {
        return view('livewire.main.cart-counter');
    }
}
  