<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionLogController;  
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Remove duplicate dashboard route
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Product routes
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    
    // Resource routes
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class); // Exclude edit route
    Route::resource('suppliers', SupplierController::class);
    Route::resource('transaction_log', TransactionLogController::class);
    
    // Stock In routes
    Route::resource('stockin', StockInController::class);
    Route::put('/stockin/{stockin}/status', [StockInController::class, 'updateStatus'])
        ->name('stockin.update-status');

    // Transaction (POS) routes
    Route::prefix('transaction')->name('transaction.')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('index');
        Route::post('/add', [TransactionController::class, 'addProduct'])->name('add');
        Route::put('/update-quantity/{id}', [TransactionController::class, 'updateQuantity'])->name('updateQuantity');
        Route::delete('/remove/{id}', [TransactionController::class, 'removeProduct'])->name('remove');
        Route::post('/complete', [TransactionController::class, 'completeTransaction'])->name('complete');
    });
});

require __DIR__.'/auth.php';