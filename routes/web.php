<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminSiteController;
use App\Http\Controllers\Normal_View\SiteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'register']);
Route::get('/verification/{token}/{user}', [AuthController::class, 'verification']);

Route::get('/', [SiteController::class, 'home']);
Route::get('/about-us', [SiteController::class, 'about']);
Route::get('/contact-us', [SiteController::class, 'contact']);
Route::get('/view-products', [SiteController::class, 'viewProducts']);

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/profile', [SiteController::class, 'profile']);
    Route::get('/products', [SiteController::class, 'product']);
    // Route::get('/cart', [SiteController::class, 'myCart']);
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin/dashboard', [AdminSiteController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/contact', [AdminSiteController::class, 'contact']);
    Route::get('/admin/about', [AdminSiteController::class, 'about']);
    Route::get('/admin/profile', [AdminSiteController::class, 'profile']);
    Route::get('/admin/users', [AdminSiteController::class, 'user']);
    Route::get('/admin/products', [AdminSiteController::class, 'product']);
    Route::get('/admin/product-categories', [AdminSiteController::class, 'category']);
});
