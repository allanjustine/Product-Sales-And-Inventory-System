<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;

class Index extends Component
{

    public $orderToCancel;
    public $reason_of_cancellation;

    public function processOrder($id)
    {
        $order = Order::findOrFail($id);
        if ($order->order_status == 'Cancelled') {

            alert()->warning('Sorry', 'The order does not exist or been cancelled by the user');

            return redirect('/admin/orders');
        }

        $order->update([
            'order_status' => 'Processing Order'
        ]);
        // session()->flash('message', 'The order is now processing');

        $this->dispatchBrowserEvent('success', ['message' => 'The order is now processing']);

        // alert()->success('Congrats', 'The order is now processing');

        // return redirect('/admin/orders');

    }
    public function markAsDeliver($id)
    {
        $order = Order::findOrFail($id);

        if ($order->order_status == 'Cancelled') {

            $this->alert()->warning('Sorry', 'The order does not exist or been cancelled by the user');

            return redirect('/admin/orders');
        }

        $order->update([
            'order_status' => 'To Deliver'
        ]);
        // session()->flash('message', 'The order is on going to deliver');

        $this->dispatchBrowserEvent('success', ['message' => 'The order is on going to deliver']);
        // alert()->success('Congrats', 'The order is on going to deliver');

        // return redirect('/admin/orders');
    }

    public function markAsDelivered($id)
    {
        $order = Order::findOrFail($id);

        if ($order->order_status == 'Cancelled') {

            alert()->warning('Sorry', 'The order does not exist or been cancelled by the user');

            return redirect('/admin/orders');
        }

        $order->update([
            'order_status' => 'Delivered'
        ]);
        $this->dispatchBrowserEvent('success', ['message' => 'The order is now delivered']);
        // session()->flash('message', 'The order is now delivered');
        // alert()->success('Congrats', 'The order is now delivered');

        // return redirect('/admin/orders');
    }


    public function markAsPaid($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'order_status' => 'Paid'
        ]);
        // session()->flash('message', 'The order is now paid');
        $this->dispatchBrowserEvent('success', ['message' => 'The order is now paid']);
        // alert()->success('Congrats', 'The order is now paid');

        // return redirect('/admin/orders');
    }
    public function orderDetails()
    {
        $grandTotal = Order::whereNotIn('order_status', ['Paid'])
            ->whereNotIn('order_status', ['Cancelled'])
            ->sum('order_total_amount');

        $orders = Order::orderBy('created_at', 'desc')->where('order_status', 'Pending')
            ->orWhere('order_status', 'Processing Order')
            ->orWhere('order_status', 'To Deliver')
            ->orWhere('order_status', 'Delivered')
            ->orWhere('order_status', 'Complete')
            ->get();

        return compact('orders', 'grandTotal');
    }

    public function cancelOrder($id)
    {
        $this->orderToCancel = Order::find($id);
    }

    public function cancel()
    {
        $this->validate([
            'reason_of_cancellation'         =>              ['required', 'min:10', 'max:255']
        ]);

        $order = Order::where('id', $this->orderToCancel->id)->first();
        $order->order_status = 'Cancelled';
        $order->reason_of_cancellation = $this->reason_of_cancellation;
        $order->save();

        alert()->success('Success Cancellation', 'The order ' . $order->product->product_name . ' cancelled successfully');
        return redirect('/admin/orders');
    }

    public function render()
    {
        return view('livewire.admin.orders.index', $this->orderDetails());
    }
}
