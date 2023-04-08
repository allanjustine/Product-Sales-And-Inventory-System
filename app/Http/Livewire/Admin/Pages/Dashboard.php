<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function count()
    {
        $usersCount = User::role('user')->count();
        $adminsCount = User::role('admin')->count();
        $productsCount = Product::count();
        $categoriesCount = ProductCategory::count();
        $ordersCount = Order::where('order_status', 'Pending')->count();
        $productSalesCount = Order::where('order_status', 'Paid')->count();

        return compact('usersCount', 'adminsCount', 'productsCount', 'categoriesCount', 'ordersCount', 'productSalesCount');
    }
    public function render()
    {
        return view('livewire.admin.pages.dashboard', $this->count());
    }
}
