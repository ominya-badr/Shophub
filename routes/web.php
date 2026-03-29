<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Contact;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::post('/cart-update', [CartController::class,'cartUpdate'])->name('cart.update');
    Route::post('/order', [CartController::class,'order'])->name('order.post');
    Route::get('/order-success', [CartController::class,'orderSuccess'])->name('order.success');

    Route::post('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

});
Route::get('/', [HomeController::class, 'featuredproducts'])->name('home');
Route::get('/home/products', [HomeController::class, 'index'])->name('home-products');
Route::get('/home/about', [HomeController::class, 'about'])->name('home-about');
Route::get('/home/contact', [HomeController::class, 'contact'])->name('home-contact');
Route::get('/home/product/{id}', [HomeController::class, 'product'])->name('home-product');
Route::get('/home/category/{id}', [HomeController::class, 'category'])->name('category.filter');
Route::post('/message', [ContactController::class, 'contactMessage'])->name('contact.message');
Route::get('add-to-cart/{id}', [CartController::class,'addAtCart'])->name('add.to.cart');
Route::get('/cart', [CartController::class,'cart'])->name('cart');
require __DIR__ . '/auth.php';
