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
    public $cancelled;

    public function mount()
    {

        $this->pendings = Order::where('order_status', 'Pending')->where('user_id', auth()->id())->get();
        $this->grandTotalPending = Order::where('user_id', auth()->id())
            ->whereNotIn('order_status', ['Paid'])
            ->sum('order_total_amount');

        $this->recents = Order::where('order_status', 'Paid')->where('user_id', auth()->id())->get();
        $this->grandTotalRecent = Order::where('user_id', auth()->id())
            ->whereNotIn('order_status', ['Pending'])
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
        } else {
            alert()->error('Sorry', 'The order you are trying to cancel does not exist');

            return redirect('/orders');
        }
    }

    public function render()
    {
        return view('livewire.normal-view.orders.index');
    }
}
