<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\categoriesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/Product', function () {
    return view('public.productPage');
})->name('product');

Route::get('/Checkout', function () {
    return view('public.checkout');
})->name('Checkout');

// Route::get('/Cart', function () {
//     return view('public.cart');
// })->name('cart');

Route::get('/shop', function () {
    return view('public.shop');
})->name('StichedForm');

Route::get('/stichedForm', function () {
    return view('public.forms.stichedForm');
})->name('stichedForm')->middleware('auth');

Route::get('/homePageForm', function () {
    return view('public.forms.homepageForm');
})->name('homePageForm')->middleware('auth');

Route::get('/login', function () {
    return view('welcome');
})->name('login');


// Route::get('/MainDashboard', function () {
//     return view('/public.dashboard.Maindashboard');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('category_form', categoriesController::class)->except(['index','show']);

Route::get('/stiched', [categoriesController::class, 'stiched'])->name('stiched');
Route::get('/unstiched', [categoriesController::class, 'unstitched'])->name('unstiched');
Route::get('/', [categoriesController::class, 'homePage'])->name('home');
Route::get('/Cart', [CartController::class, 'index'])->name('cart');
Route::post('/CartStore', [CartController::class, 'store'])->name('cart.store');

Route::get('/shop/{id}', [categoriesController::class, 'show'])->name('shop.show');
Route::post('/cart/store', [categoriesController::class, 'store'])->name('cart.store');

// shop page route
Route::get('/shop', [categoriesController::class, 'shopPage'])->name('shopPage');

require __DIR__.'/auth.php';

