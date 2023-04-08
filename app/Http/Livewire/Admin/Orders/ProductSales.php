<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;

class ProductSales extends Component
{
    public $orders;
    public $grandTotal;

    public function mount()
    {
        $this->orders = Order::where('order_status', 'Paid')->get();
        $this->grandTotal = Order::whereNotIn('order_status', ['Pending'])
            ->sum('order_total_amount');
    }
    public function render()
    {
        return view('livewire.admin.orders.product-sales');
    }
}
