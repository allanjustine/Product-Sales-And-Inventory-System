<?php

namespace App\Http\Livewire\Admin\Layout;

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
        $categoriesCount = ProductCategory::count();

        return compact('usersCount', 'productsCount', 'categoriesCount');
    }
    public function render()
    {
        return view('livewire.admin.layout.sidebar', $this->count());
    }
}
