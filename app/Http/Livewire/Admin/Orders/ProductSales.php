<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class ProductSales extends Component
{
    public $grandTotal;
    public $perPage = 5;
    public $search;
    public $sortBy = 'transaction_code';
    public $sortDirection = 'asc';

    use WithPagination;

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function displaySales()
    {
        $orders = Order::join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name', 'products.product_name')
            ->leftJoin('products', 'orders.product_id', '=', 'products.id')
            ->where(function ($query) {
                $query->where('transaction_code', 'like', '%' . $this->search . '%')
                    ->orWhere('order_payment_method', 'like', '%' . $this->search . '%')
                    ->orWhere('users.name', 'like', '%' . $this->search . '%')
                    ->orWhere('products.product_name', 'like', '%' . $this->search . '%')
                    ->orWhere('orders.created_at', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->whereNotIn('order_status', ['Pending'])
            ->whereNotIn('order_status', ['Complete'])
            ->whereNotIn('order_status', ['To Deliver'])
            ->whereNotIn('order_status', ['Delivered'])
            ->whereNotIn('order_status', ['Cancelled'])
            ->paginate($this->perPage);

        return compact('orders');
    }

    public function mount()
    {
        $this->grandTotal = Order::whereNotIn('order_status', ['Pending'])
            ->whereNotIn('order_status', ['Complete'])
            ->whereNotIn('order_status', ['To Deliver'])
            ->whereNotIn('order_status', ['Delivered'])
            ->whereNotIn('order_status', ['Cancelled'])
            ->sum('order_total_amount');
    }
    public function render()
    {
        return view('livewire.admin.orders.product-sales', $this->displaySales());
    }
}
