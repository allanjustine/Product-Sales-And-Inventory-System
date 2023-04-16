<?php

namespace App\Http\Livewire\Admin\Layout;

use App\Models\Contact;
use App\Models\Order;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class Sidebar extends Component
{

    public function count()
    {
        $usersCount = User::where('id', '<>', auth()->id())->count();
        $productsCount = Product::count();
        $feedbacks = Contact::count();
        $categoriesCount = ProductCategory::count();
        $ordersCount = Order::where('order_status', 'Pending')
            ->orWhere('order_status', 'Complete')
            ->orWhere('order_status', 'To Deliver')
            ->orWhere('order_status', 'Delivered')
            ->count();
        $productSalesCount = Order::where('order_status', 'Paid')->count();

        return compact(
            'usersCount',
            'productsCount',
            'categoriesCount',
            'ordersCount',
            'productSalesCount',
            'feedbacks'
        );
    }
    public function render()
    {
        return view('livewire.admin.layout.sidebar', $this->count());
    }
}
