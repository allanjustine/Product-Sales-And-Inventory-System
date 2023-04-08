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
        $this->orders = Order::where('order_status', 'Pending')->get();
        $this->grandTotal = Order::whereNotIn('order_status', ['Paid'])
            ->sum('order_total_amount');
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
