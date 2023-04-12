<?php

namespace App\Http\Livewire\NormalView\Orders;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;

class Index extends Component
{

    public $recents;
    public $pendings;
    public $grandTotalPending;
    public $grandTotalRecent;
    public $cancel;
    public $receive;
    public $received;
    public $cancelled;
    public $product_rating;
    public $product;

    protected $listeners = ['resetInputs'];

    public function mount()
    {

        $this->pendings = Order::where('order_status', 'To Deliver')
            ->orWhere('order_status', 'Pending')
            ->orWhere('order_status', 'Delivered')
            ->where('user_id', auth()->id())->get();
        $this->grandTotalPending = Order::where('user_id', auth()->id())
            ->whereNotIn('order_status', ['Paid'])
            ->whereNotIn('order_status', ['Complete'])
            ->sum('order_total_amount');

        $this->recents = Order::where('order_status', 'Paid')
            ->where('user_id', auth()->id())
            ->orWhere('order_status', 'Complete')
            ->get();
        $this->grandTotalRecent = Order::where('user_id', auth()->id())
            ->whereNotIn('order_status', ['Pending'])
            ->whereNotIn('order_status', ['To Deliver'])
            ->whereNotIn('order_status', ['Delivered'])
            ->sum('order_total_amount');
    }

    public function toCancel($orderId)
    {
        $this->cancel = Order::find($orderId);

        $this->cancelled = $orderId;
    }

    public function cancelOrder()
    {
        $order = Order::where('id', $this->cancelled)->first();

        if ($order->order_status == 'Pending') {
            $product = Product::find($order->product_id);
            $product->product_stock += $order->order_quantity;
            $product->product_sold -= $order->order_quantity;
            $product->save();

            $order->delete();

            alert()->info('Cancelled', 'The order has been cancelled successfully');

            return redirect('/orders');
        } elseif ($order->order_status == 'To Deliver') {

            alert()->error('Sorry', 'The order you are trying to cancel is on going to deliver');
            return redirect('/orders');
        } elseif ($order->order_status == 'Delivered') {

            alert()->error('Sorry', 'The order you are trying to cancel is already delivered');
            return redirect('/orders');
        } elseif ($order->order_status == 'Complete') {

            alert()->error('Sorry', 'The order you are trying to cancel is already complete');
            return redirect('/orders');
        } else {
            alert()->error('Sorry', 'The order you are trying to cancel does not exist');

            return redirect('/orders');
        }
    }

    public function toReceived($orderId)
    {
        $this->receive = Order::find($orderId);

        $this->received = $orderId;
    }

    public function submitRating()
    {
        $received = Order::where('id', $this->received)->first();

        $product = Product::find($received->product_id);

        $this->validate([
            'product_rating'        =>          'required|numeric|min:1|max:5'
        ]);

        $product->product_rating = ($product->product_rating * $product->product_votes + $this->product_rating) / ($product->product_votes + 1);
        $product->product_votes += 1;
        $product->save();

        $received->order_status = 'Complete';
        $received->save();

        $newRating = $this->product_rating;
        alert()->success('Success', 'Thank you for rating us ' . $newRating . ' Star(s).');

        return redirect('/orders');
    }

    public function resetInputs()
    {
        $this->product_rating = '';

        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.normal-view.orders.index');
    }
}
