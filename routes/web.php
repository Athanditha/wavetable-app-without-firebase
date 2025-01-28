<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CustomerController;
use App\Models\Customer;
use App\Livewire\UserLogin;
use App\Livewire\AdminLogin;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SearchController;

route::get('/home',[HomeController::class,'index']);
Route::get('/register', [PageController::class,
'custregister'])->name('register');
Route::get('/', [ItemController::class, 'showOnCustomerHome'])->name('itemsviewer');

Route::get('/user/login', UserLogin::class)->name('user.login');
Route::get('/admin/login', AdminLogin::class)->name('admin.login');


Route::get('/register', function () {
    return view('auth.register'); 
})->name('register');

Route::middleware('admin')->group(function () {
    Route::get('/admin/items', [HomeController::class, 'items']);
    Route::get('/admin/analytics', [PageController::class, 'analytics']);
    Route::get('/admin', [PageController::class, 'admin'])->name('admin.dashboard');
    Route::get('/items/{id}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{id}', [ItemController::class, 'update'])->name('items.update');
});

Route::get('/items/{id}', [ItemController::class, 'show'])->name('items.show');
Route::get('/welcome', [PageController::class, 'welcome'])->name('welcome');
Route::get('/search', [SearchController::class, 'search'])->name('search');
