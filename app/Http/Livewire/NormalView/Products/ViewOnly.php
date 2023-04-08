<?php

namespace App\Http\Livewire\NormalView\Products;

use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Component;
use Livewire\WithPagination;

class ViewOnly extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;
    public $perPage = 15;
    public $category_name = 'All';
    public $sort = 'low_to_high';
    public $product_rating = 'All';
    public $productView;

    public function displayProducts()
    {
        $query = Product::search($this->search);

        if ($this->category_name != 'All') {
            $query->whereHas('product_category', function ($q) {
                $q->where('category_name', $this->category_name);
            });
        }

        if ($this->sort === 'low_to_high') {
            $query->orderBy('product_price', 'desc');
        } else {
            $query->orderBy('product_price', 'asc');
        }

        if ($this->product_rating != 'All') {
            $query->where('product_rating', $this->product_rating);
        }

        $products = $query->paginate($this->perPage);

        return compact('products');
    }
    public function view($id)
    {
        $this->productView = Product::find($id);
    }
    public function render()
    {
        $product_categories = ProductCategory::all();

        return view('livewire.normal-view.products.view-only', $this->displayProducts(), ['product_categories' => $product_categories]);
    }
}
