<?php

namespace App\Http\Livewire\NormalView\Carts;

use App\Models\Cart;
use Livewire\Component;

class Index extends Component
{

    public $cartItems;

    public function mount()
    {
        $this->cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
    }



    public function render()
    {
        return view('livewire.normal-view.carts.index')->layout('pages.normal-view.layout.base');
    }
}
