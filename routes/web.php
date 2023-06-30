<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Demo\DemoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Pos\CategoryController;
use App\Http\Controllers\Pos\CustomerController;
use App\Http\Controllers\Pos\DefaultController;
use App\Http\Controllers\Pos\ProductController;
use App\Http\Controllers\Pos\PurchasesController;
use App\Models\Supplier;
use App\Http\Controllers\Pos\SupplierController;
use App\Http\Controllers\Pos\UnitsController;

// Admin All Route
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'Profile')->name('admin.profile');
    Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->name('store.profile');

    Route::get('/change/password', 'ChangePassword')->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->name('update.password');

});

// Supplier All Route
Route::controller(SupplierController::class)->group(function () {
    Route::get('/Supplier/All', 'SupplierAll')->name('supplier.all');
    Route::get('/Supplier/Add', 'SupplierAdd')->name('supplier.add');
    Route::post('/Supplier/store', 'SupplierStore')->name('supplier.store');
    Route::get('/Supplier/edit/{id}', 'SupplierEdit')->name('supplier.edit');
    Route::post('/Supplier/update', 'SupplierUpdate')->name('supplier.update');
    Route::get('/Supplier/delete/{id}', 'SupplierDelete')->name('supplier.delete');

});

// Customer All Route
Route::controller(CustomerController::class)->group(function () {
    Route::get('/Customer/All', 'CustomerAll')->name('customer.all');
    Route::get('/Customer/Add', 'CustomerAdd')->name('customer.add');
    Route::post('/Customer/store', 'CustomerStore')->name('customer.store');
    Route::get('/Customer/edit/{id}', 'CustomerEdit')->name('customer.edit');
    Route::post('/Customer/update', 'CustomerUpdate')->name('customer.update');
    Route::get('/Customer/delete/{id}', 'CustomerDelete')->name('customer.delete');

});

// Unit All Route
Route::controller(UnitsController::class)->group(function () {
    Route::get('/unit/All', 'UnitAll')->name('unit.all');
    Route::get('/unit/Add', 'UnitAdd')->name('unit.add');
    Route::post('/unit/store', 'UnitStore')->name('unit.store');
    Route::get('/unit/edit/{id}', 'UnitEdit')->name('unit.edit');
    Route::post('/unit/update', 'UnitUpdate')->name('unit.update');
    Route::get('/unit/delete/{id}', 'UnitDelete')->name('unit.delete');

});

// Catergory All Route
Route::controller(CategoryController::class)->group(function () {
    Route::get('/category/All', 'CategoryAll')->name('category.all');
    Route::get('/category/Add', 'CategoryAdd')->name('category.add');
    Route::post('/category/store', 'CategoryStore')->name('category.store');
    Route::get('/category/edit/{id}', 'CategoryEdit')->name('category.edit');
    Route::post('/category/update', 'CategoryUpdate')->name('category.update');
    Route::get('/category/delete/{id}', 'CategoryDelete')->name('category.delete');

});

// Product All Route
Route::controller(ProductController::class)->group(function () {
    Route::get('/product/All', 'productAll')->name('product.all');
    Route::get('/product/Add', 'productAdd')->name('product.add');
    Route::post('/product/store', 'productStore')->name('product.store');
    Route::get('/product/edit/{id}', 'productEdit')->name('product.edit');
    Route::post('/product/update', 'productUpdate')->name('product.update');
    Route::get('/product/delete/{id}', 'productDelete')->name('product.delete');

});

// Purchases All Route
Route::controller(PurchasesController::class)->group(function () {
    Route::get('/purchases/All', 'purchasesAll')->name('purchases.all');
    Route::get('/purchases/Add', 'purchasesAdd')->name('purchases.add');
    Route::post('/purchases/store', 'purchasesStore')->name('purchases.store');
    Route::get('/purchases/edit/{id}', 'purchasesEdit')->name('purchases.edit');
    Route::post('/purchases/update', 'purchasesUpdate')->name('purchases.update');
    Route::get('/purchases/delete/{id}', 'purchasesDelete')->name('purchases.delete');

});

// Default All Route
Route::controller(DefaultController::class)->group(function () {
    Route::get('/get-category', 'GetCategory')->name('get-category');
    Route::get('/get-product', 'GetProduct')->name('get-product');

});

Route::get('/', function () {
    return view('admin.index');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';