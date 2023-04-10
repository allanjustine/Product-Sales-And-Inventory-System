<?php

namespace App\Http\Livewire\NormalView\Products;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    protected $listeners = ['resetInputs'];

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
    public $cartItemToRemove;
    public $cartItemToCheckOut;
    public $itemRemove;
    public $itemPlaceOrder;
    public $item, $updateCartItem;
    public $order_payment_method;
    public $user_location;
    public $product_sold;

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

    public function remove($itemId)
    {
        $this->cartItemToRemove = Cart::find($itemId);

        $this->itemRemove = $itemId;
    }

    public function removeItemToCart()
    {
        $product = Cart::where('id', $this->itemRemove)->first();

        $product->delete();

        alert()->toast('Removed from cart successfully', 'success');

        return redirect('/products');
    }

    public function checkOut($itemId)
    {
        $this->cartItemToCheckOut = Cart::find($itemId);

        $this->itemPlaceOrder = $itemId;
    }

    public function placeOrder()
    {
        $cartItem = Cart::find($this->itemPlaceOrder);

        $this->validate([
            'order_payment_method'  =>      'required',
            'user_location'         =>      'required|max:255'
        ]);

        $product = $cartItem->product;
        $productQuantity = $product->product_stock;
        $productStatus = $product->product_status;

        if ($cartItem->quantity <= $productQuantity && $productStatus == 'Available') {
            $transactionCode = 'AJM-' . Str::random(10);

            $existingOrder = Order::where([
                ['user_id', auth()->id()],
                ['product_id', $product->id]
            ])->first();

            if ($existingOrder) {
                if ($existingOrder->order_status == 'Paid') {
                    $order = new Order();
                    $order->user_id = auth()->id();
                    $order->product_id = $product->id;
                    $order->order_quantity = $cartItem->quantity;
                    $order->user_location = $this->user_location;
                    $order->order_price = $product->product_price;
                    $order->order_total_amount = $cartItem->quantity * $product->product_price;
                    $order->order_payment_method = $this->order_payment_method;
                    $order->order_status = 'Pending';
                    $order->transaction_code = $transactionCode;
                    $order->save();
                } else {
                    $existingOrder->order_quantity += $cartItem->quantity;
                    $existingOrder->order_total_amount += ($cartItem->quantity * $product->product_price);
                    $existingOrder->save();
                }
            } else {
                $order = new Order();
                $order->user_id = auth()->id();
                $order->product_id = $product->id;
                $order->order_quantity = $cartItem->quantity;
                $order->user_location = $this->user_location;
                $order->order_price = $product->product_price;
                $order->order_total_amount = $cartItem->quantity * $product->product_price;
                $order->order_payment_method = $this->order_payment_method;
                $order->order_status = 'Pending';
                $order->transaction_code = $transactionCode;
                $order->save();
            }

            $product->product_stock -= $cartItem->quantity;
            $product->product_sold += $cartItem->quantity;
            $product->save();
            $cartItem->delete();

            alert()->success('Congrats', 'The product ordered successfully. Your transaction code is "' . $order->transaction_code . '"');

            return redirect('/orders');
        } else {
            if ($productStatus == 'Not Available') {
                alert()->error('Sorry', 'The product is Not Available');

                return redirect('/products');
            } elseif ($product->product_stock == 0) {
                alert()->error('Sorry', 'The product is out of stock');

                return redirect('/products');
            } else {
                alert()->error('Sorry', 'The product stock is insufficient please reduce your cart quantity');

                return redirect('/products');
            }
        }
    }



    public function resetInputs()
    {
        $this->order_payment_method = '';
        $this->user_location = '';

        $this->resetValidation();
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
