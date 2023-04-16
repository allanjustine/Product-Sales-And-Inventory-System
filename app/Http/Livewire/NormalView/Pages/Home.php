<?php

namespace App\Http\Livewire\NormalView\Pages;

use App\Models\Product;
use Livewire\Component;

class Home extends Component
{

    public $topDeals;
    public $popularityDeals;
    public $productView;

    public function mount()
    {
        $this->topDeals = Product::orderBy('product_sold', 'desc')
            ->whereNotIn('product_sold', [0])
            ->take(10)
            ->get();
        $this->popularityDeals = Product::orderBy('product_votes', 'desc')
            ->whereNotIn('product_votes', [0])
            ->take(10)
            ->get();
    }
    public function view($id)
    {
        $this->productView = Product::find($id);
    }
    public function render()
    {
        return view('livewire.normal-view.pages.home');
    }
}
