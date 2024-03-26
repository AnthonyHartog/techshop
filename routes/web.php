<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShoppingcardController;
use App\Http\Controllers\SpecificationController;
use App\Http\Middleware\CheckAdmin;
use App\Models\Specification;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('products', [ProductController::class, 'index'])->name('product.index');
Route::get('/products/{id}/{productName}', [ProductController::class, 'show'])->name('product.show');
Route::post('/products', [FilterController::class, 'productFilter'])->name('product.filter');

Route::resource('shoppingcard', ShoppingcardController::class);
Route::get('/shoppingcards/delete', [ShoppingcardController::class, 'shoppingcardDelete'])->name('shoppingcards.delete');

Route::resource('order', OrderController::class)->middleware('auth');
Route::get('/order/completed/{id}/{email}', [OrderController::class, 'completed'])->name('order.completed');

Route::middleware('auth', CheckAdmin::class)->group(function () {
    Route::get('/admin/products', [ProductController::class, 'adminIndex'])->name('admin.products.index');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::get('/admin/products/edit/{id}/{productname}', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products', [ProductController::class, 'update'])->name('admin.products.update');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::delete('/admin/delete/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::resource('/admin/specification', SpecificationController::class);
    Route::resource('/admin/filters', FilterController::class);
    Route::resource('/admin/employee', EmployeeController::class);
});


require __DIR__.'/auth.php';
