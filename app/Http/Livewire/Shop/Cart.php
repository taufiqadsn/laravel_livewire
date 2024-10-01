<?php

namespace App\Http\Livewire\Shop;

use App\Facades\Cart as FacadesCart;
use Livewire\Component;

class Cart extends Component
{
    public $cart;

    public function mount()
    {
        $this->cart = FacadesCart::get();
    }
    public function render()
    {
        return view('livewire.shop.cart');
    }

    public function removeFromCart($productId)
    {
        FacadesCart::remove($productId);
        $this->cart = FacadesCart::get();
        $this->emit('removeFromCart');
    }
}
