<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\FrontendAuthController;
use App\Http\Controllers\ProfileController;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\DB;

// Route::get('/', function () {
//     return view('public.home');
// })->name('home');

// Route::get('/stiched', function () {
//     return view('public.stiched');
// })->name('stiched');

// Route::get('/unstiched', function () {
//     return view('public.unstiched');
// })->name('unstiched');

Route::get('/contact-Us', function () {
    return view('public.contact');
})->name('contact');

Route::get('/About-Us', function () {
    return view('public.about');
})->name('about');

// Route::get('/Product', function () {
//     return view('public.productPage');
// })->name('product');

// Route::get('/Checkout', function () {
//     return view('public.checkout');
// })->name('Checkout');

// Route::get('/Cart', function () {
//     return view('public.cart');
// })->name('cart');

Route::get('/shop', function () {
    return view('public.shop');
})->name('StichedForm');

Route::get('/stichedForm', function () {
    return view('public.forms.stichedForm');
})->name('stichedForm')->middleware(['auth', 'admin.context']);

Route::get('/homePageForm', function () {
    return view('public.forms.homepageForm');
})->name('homePageForm')->middleware(['auth', 'admin.context']);

Route::get('/login', function () {
    return view('welcome');
})->name('login');

Route::middleware('guest')->group(function () {
    Route::get('/account/login', [FrontendAuthController::class, 'showLogin'])->name('frontend.login');
    Route::post('/account/login', [FrontendAuthController::class, 'login'])->name('frontend.login.store');
    Route::get('/account/register', [FrontendAuthController::class, 'showRegister'])->name('frontend.register');
    Route::post('/account/register', [FrontendAuthController::class, 'register'])->name('frontend.register.store');
});

Route::post('/account/logout', [FrontendAuthController::class, 'logout'])
    ->middleware('auth')
    ->name('frontend.logout');

// Route::get('/display', function () {
//     return view('public.forms.s&u_display');
// })->name('su_display')->middleware('auth');


// Route::get('/MainDashboard', function () {
//     return view('/public.dashboard.Maindashboard');
// });

Route::get('/dashboard', function () {
    $categoryCount = Category::count();
    $cartCount = Cart::count();
    $orderCount = DB::table('orders')
        ->where(function ($query) {
            $query->whereNull('status')
                ->orWhere('status', '!=', 'removed');
        })
        ->count();
    $orderItemCounts = DB::table('order_items')
        ->select('order_id', DB::raw('COUNT(*) as items_count'))
        ->groupBy('order_id');

    $orders = DB::table('orders')
        ->leftJoinSub($orderItemCounts, 'order_item_counts', function ($join) {
            $join->on('orders.id', '=', 'order_item_counts.order_id');
        })
        ->where(function ($query) {
            $query->whereNull('orders.status')
                ->orWhere('orders.status', '!=', 'removed');
        })
        ->select('orders.*', DB::raw('COALESCE(order_item_counts.items_count, 0) as items_count'))
        ->orderByDesc('orders.id')
        ->paginate(10);
    
    return view('dashboard', compact('categoryCount', 'cartCount', 'orderCount', 'orders'));
})->middleware(['auth', 'verified', 'admin.context'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('category_form', categoriesController::class)
    ->except(['index', 'show'])
    ->middleware(['auth', 'admin.context']);

Route::get('/stiched', [categoriesController::class, 'stiched'])->name('stiched');
Route::get('/unstiched', [categoriesController::class, 'unstitched'])->name('unstiched');
Route::get('/', [categoriesController::class, 'homePage'])->name('home');
Route::get('/Cart', [CartController::class, 'index'])->name('cart');
Route::get('/Checkout', [CartController::class, 'getCheckoutData'])->name('Checkout');
Route::post('/checkoutStore', [CartController::class, 'checkoutStore'])->name('checkoutStore');
Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/remove/{id}', [CartController::class, 'itemRemove'])->name('cart.remove');
Route::delete('/cart/{id}', [CartController::class, 'itemRemove']);
Route::middleware(['auth', 'admin.context'])->group(function () {
    Route::get('/Showingorders', [CartController::class, 'showOrders'])->name('showOrders');
    Route::get('/admin/orders/history', [CartController::class, 'orderHistory'])->name('admin.orders.history');
    Route::patch('/admin/orders/{id}/status', [CartController::class, 'updateOrderStatus'])->name('admin.orders.updateStatus');
    Route::patch('/admin/orders/{id}/restore', [CartController::class, 'restoreOrder'])->name('admin.orders.restore');
    Route::delete('/admin/orders/{id}/force-delete', [CartController::class, 'forceDeleteOrder'])->name('admin.orders.forceDelete');
    Route::get('/admin/orders/{id}', [CartController::class, 'showOrderDetail'])->name('admin.orders.show');
});

// display all categories data in s&u_display page
Route::get('/display', [categoriesController::class, 'display'])->name('su_display')->middleware(['auth', 'admin.context']);


Route::get('/shop/{id}', [categoriesController::class, 'show'])->name('shop.show');

// shop page route
Route::get('/shop', [categoriesController::class, 'shopPage'])->name('shopPage');

require __DIR__.'/auth.php';
