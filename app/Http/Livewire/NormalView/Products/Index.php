<?php

namespace App\Http\Livewire\NormalView\Products;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;
    public $perPage = 15;
    public $category_name = 'All';
    public $sort = 'low_to_high';
    public $product_rating = 'All';
    public $productView;
    public $productToBeCart;
    public $selectedProductID, $productId, $product_name, $product_price;
    public $quantity = 1;
    public $product;
    public $cartItems;
    public $item, $updateCartItem;

    public function displayProducts()
    {
        $query = Product::search($this->search);

        if ($this->category_name != 'All') {
            $query->whereHas('product_category', function ($q) {
                $q->where('category_name', $this->category_name);
            });
        }
        if ($this->sort === 'low_to_high') {
            $query->orderBy('product_price', 'asc');
        } else {
            $query->orderBy('product_price', 'desc');
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

    public function addToCart($id)
    {
        $this->productToBeCart = Product::find($id);
    }

    public function addToCartNow()
    {
        $this->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $this->productToBeCart->id)
            ->first();

        if ($cart) {
            $cart->update([
                'quantity' => $cart->quantity + $this->quantity,
            ]);
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $this->productToBeCart->id,
                'quantity' => $this->quantity,
            ]);
        }

        alert()->success('Success', 'Product added to cart successfully.');

        return redirect('/products');
    }

    public function mount()
    {
        $this->cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();
    }

    public function getTotal()
    {
        $total = 0;

        foreach ($this->cartItems as $item) {
            $total += $item->product->product_price * $item->quantity;
        }

        return $total;
    }

    public function updateCartItem($cartItemId)
    {

        $this->validate([
            'quantity'          =>          'required|integer|min:1'
        ]);

        $cart = Cart::find($cartItemId);

        if ($cart && $cart->user_id === auth()->id()) {
            $cart->update([
                'quantity' => $cart->quantity + $this->quantity,
            ]);
        }

        alert()->toast('Updated cart quantity successfully', 'success');

        return redirect('/products');
    }

    public function decreaseQuantity($itemId)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('id', $itemId)
            ->first();

        if ($cart) {
            $updatedQuantity = $cart->quantity - 1;

            if ($updatedQuantity > 0) {
                $cart->update([
                    'quantity' => $updatedQuantity,
                ]);

                alert()->toast('Updated cart quantity successfully', 'success');
                return redirect('/products');
            } else {
                $cart->delete();

                alert()->toast('The item was removed', 'success');

                return redirect('/products');
            }
        }
    }

    public function removeCartItem($itemId)
    {
        $item = Cart::findOrFail($itemId);

        $item->delete();

        alert()->toast('Removed from cart successfully', 'success');

        return redirect('/products');
    }

    public function checkOut()
    {

        alert()->toast('You checkout the product successfully', 'success');

        return redirect('/products');
    }

    public function render()
    {
        $product_categories = ProductCategory::all();

        return view(
            'livewire.normal-view.products.index',
            $this->displayProducts(),
            [
                'product_categories' => $product_categories,
                'cartItems' => $this->cartItems,
                'total' => $this->getTotal()
            ]
        );
    }
}
