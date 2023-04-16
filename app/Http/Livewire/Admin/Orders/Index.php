<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;

class Index extends Component
{
    public $orders;
    public $grandTotal;

    public function mount()
    {
        $this->orders = Order::where('order_status', 'Pending')
            ->orWhere('order_status', 'To Deliver')
            ->orWhere('order_status', 'Delivered')
            ->orWhere('order_status', 'Complete')
            ->get();
        $this->grandTotal = Order::whereNotIn('order_status', ['Paid'])
            ->whereNotIn('order_status', ['Cancelled'])
            ->sum('order_total_amount');
    }

    public function markAsDeliver($orderId)
    {
        $order = Order::findOrFail($orderId);

        $order->update([
            'order_status' => 'To Deliver'
        ]);

        alert()->success('Congrats', 'The order is on going to deliver');

        return redirect('/admin/orders');
    }

    public function markAsDelivered($orderId)
    {
        $order = Order::findOrFail($orderId);

        $order->update([
            'order_status' => 'Delivered'
        ]);

        alert()->success('Congrats', 'The order is now delivered');

        return redirect('/admin/orders');
    }


    public function markAsPaid($orderId)
    {
        $order = Order::findOrFail($orderId);

        $order->update([
            'order_status' => 'Paid'
        ]);

        alert()->success('Congrats', 'The order is now paid');

        return redirect('/admin/orders');
    }

    public function render()
    {
        return view('livewire.admin.orders.index');
    }
}
