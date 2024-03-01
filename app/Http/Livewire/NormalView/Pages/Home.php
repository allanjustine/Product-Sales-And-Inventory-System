<?php

namespace App\Http\Livewire\NormalView\Pages;

use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class Home extends Component
{

    public $topDeals;
    public $popularityDeals;
    public $productView;
    public $latestProducts;
    public $allLocations;

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
        $this->latestProducts = Product::orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $this->allLocations = User::all();
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
