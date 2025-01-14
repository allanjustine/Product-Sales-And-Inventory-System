<?php

namespace App\Http\Livewire\NormalView\Favorites;

use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;

class Index extends Component
{

    public $productToBeCart;
    public $productView;
    public $orderToBuy;
    public $quantity = 1;
    public $user_location;
    public $order_quantity = 1;
    public $order_payment_method;
    public $orderPlaceOrder;


    public function displayAllFavorites()
    {
        $allFavorites = Favorite::where(['user_id' => auth()->user()->id, 'status' => true])->latest()->get();

        return compact('allFavorites');
    }

    public function notAvailable()
    {
        $this->dispatchBrowserEvent('error', ['message' => 'This product is not available.']);
    }

    public function outOfStock()
    {
        $this->dispatchBrowserEvent('error', ['message' => 'This product is out of stock.']);
    }

    public function removeToFavorite($id)
    {
        Favorite::findOrFail($id)->delete();

        $this->dispatchBrowserEvent('success', ['message' => 'Removed from favorites.']);
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

        $this->dispatchBrowserEvent('success', ['message' => 'Product added to cart successfully.']);
        $this->reset();

        // alert()->success('Success', 'Product added to cart successfully.');

        // return redirect('/favorites');
    }

    public function toBuyNow($productId)
    {

        $this->orderToBuy = Product::findOrFail($productId);

        if (auth()->check()) {
            $this->user_location = auth()->user()->user_location;
        }

        $this->orderPlaceOrder = $productId;
    }

    public function orderPlaceOrder()
    {

        $product = Product::find($this->orderPlaceOrder);

        $this->validate([
            'order_payment_method'  =>      'required',
            'user_location'         =>      'required|max:255',
            'order_quantity'        =>      ['required', 'numeric', 'min:1'],
        ]);

        $productQuantity = $product->product_stock;
        $productStatus = $product->product_status;

        if ($productStatus == 'Available' && $productQuantity >= $this->order_quantity) {
            $existingOrder = Order::where([
                ['user_id', auth()->id()],
                ['product_id', $product->id],
                ['order_status', 'Pending']
            ])->first();

            if ($existingOrder) {
                $user = User::where('id', auth()->user()->id);

                $user->update([
                    'user_location' => $this->user_location
                ]);
                $existingOrder->created_at = now();
                $existingOrder->order_quantity += $this->order_quantity;
                $existingOrder->order_total_amount += ($this->order_quantity * $product->product_price);
                $existingOrder->save();
            } else {
                $transactionCode = 'AJM-' . Str::random(10);

                $order = new Order();
                $order->user_id = auth()->id();
                $order->product_id = $product->id;
                $order->order_quantity = $this->order_quantity;
                $order->order_price = $product->product_price;
                $order->order_total_amount = $this->order_quantity * $product->product_price;
                $order->order_payment_method = $this->order_payment_method;
                $order->order_status = 'Pending';
                $order->transaction_code = $transactionCode;
                $order->save();

                $user = User::where('id', auth()->user()->id);

                $user->update([
                    'user_location' => $this->user_location
                ]);
            }

            $product->product_stock -= $this->order_quantity;
            $product->product_sold += $this->order_quantity;
            $product->save();


            if ($existingOrder) {
                // alert()->success('Congrats', 'The product is added/changed to your existing order.');
                alert()->html('Congrats', 'The product is added/changed to your existing order.' . '<br><br><a class="btn btn-primary" href="/orders">Go to Orders</a>', 'success');
            } else {
                alert()->html('Congrats', 'The product ordered successfully. Your transaction code is "' . $order->transaction_code . '"' . '<br><br><a class="btn btn-primary" href="/orders">Go to Orders</a>', 'success');
            }

            return redirect('/favorites');
        } else {

            if ($productStatus == 'Not Available') {
                // alert()->error('Sorry', 'The product is Not Available');

                // return redirect('/favorites');

                $this->dispatchBrowserEvent('error', ['message' => 'The product is Not Available']);
            } elseif ($product->product_stock == 0) {
                // alert()->error('Sorry', 'The product is out of stock');

                // return redirect('/favorites');
                $this->dispatchBrowserEvent('warning', ['message' => 'The product is out of stock']);
            } else {
                // alert()->error('Sorry', 'The product stock is insufficient please reduce your cart quantity');

                // return redirect('/favorites');
                $this->dispatchBrowserEvent('info', ['message' => 'The product stock is insufficient please reduce your cart quantity']);
            }
        }
    }

    public function render()
    {
        return view('livewire.normal-view.favorites.index', $this->displayAllFavorites());
    }
}
