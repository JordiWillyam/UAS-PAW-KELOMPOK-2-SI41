<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderSupplierController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseTest;
use App\Http\Controllers\StokController;
use App\Models\Product;
use App\Models\Setting;

Route::get('/', function () {
    return redirect('/admin');
});

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    Route::resource('products', ProductController::class);
    // Route::resource('stok', StokController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('orders', OrderController::class);

    //Gudang
    Route::get('/stok/index', [StokController::class,'index'])->name('stok.index');
    Route::post('/stok/store', [StokController::class,'store'])->name('stok.store');
    Route::get('/stok/{product}/edit', [StokController::class, 'edit'])->name('stok.edit');
    Route::put('/stok/{product}', [StokController::class,'update'])->name('stok.update');

    // Route to show the form to create a new stock
    Route::get('admin/stok/create', [StokController::class, 'create'])->name('stok.create');

    // Route to handle the form submission and store the new stock
    Route::post('admin/stok', [StokController::class, 'store'])->name('stok.store');



    // Route::post('/admin/ordersuppliers', [OrderSupplierController::class, 'store']);
    // Route::view('/ordersuppliers', 'ordersuppliers.index');
    Route::resource('suppliers', SupplierController::class);
    Route::resource('purchases', PurchaseController::class);
    // Route::get('/purchase', PurchaseController::class,'index')->name('purchases.index');
    // Route::post('/purchase/store', [PurchaseController::class, 'store'])->name('purchase.store');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/change-qty', [CartController::class, 'changeQty']);
    Route::delete('/cart/delete', [CartController::class, 'delete']);
    Route::delete('/cart/empty', [CartController::class, 'empty']);

    // Route::post('purchase/store', OrderSupplierController::class,'store');
    Route::resource('/ordersuppliers', OrderSupplierController::class);
    Route::resource('purchase', PurchaseController::class);
    Route::get('/purchase', [PurchaseController::class,'index'])->name('purchases.index');
    Route::post('/purchase', [PurchaseController::class, 'store'])->name('purchase.store');
    Route::post('/purchase/change-qty', [PurchaseController::class, 'changeQty']);
    Route::post('/purchase/delete', [PurchaseController::class, 'delete']);
    Route::post('/purchase/empty', [PurchaseController::class, 'empty']);


    Route::get('/orders/cetak/cart', [OrderController::class,'cetak'])->name('orders.cetak');
    Route::get('/products/cetak/products', [ProductController::class,'cetak'])->name('products.cetak');
    Route::get('/cetak', [OrderSupplierController::class,'cetak'])->name('ordersupplier.cetak');
    // Route::get('/customers', [CustomerController::class,'index'])->name('customers.index');
    // Route::get('/customers', [CustomerController::class,'search'])->name('customers.search');

    //Penjualan
    Route::get('/penjualan', [PenjualanController::class,'index'])->name('penjualan.index');
    Route::get('/stok/cetak', [StokController::class,'cetak'])->name('stok.cetak');
    Route::post('/penjualan/store', [PenjualanController::class, 'store'])->name('penjualan.store');
    Route::get('/orders/notakecil/{id}', [OrderController::class, 'cetakNota'])->name('orders.notakecil');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');


});

// Route::prefix('admin')->middleware(['auth', 'check.role:owner,all'])->group(function () {
//     // Rute untuk Owner dan peran 'all'
// });

// Route::prefix('admin')->middleware(['auth', 'check.role:kasir,all'])->group(function () {
//     // Rute untuk Kasir dan peran 'all'
// });

// Route::prefix('admin')->middleware(['auth', 'check.role:gudang,all'])->group(function () {
//     // Rute untuk Gudang dan peran 'all'
// });


// Route::get('/admin/products', [ProductController::class, 'index']);
// Route::get('/admin/suppliers', [SupplierController::class, 'index']);
// Route::post('/admin/ordersuppliers', [OrderSupplierController::class, 'store']);
