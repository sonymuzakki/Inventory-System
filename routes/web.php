<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Demo\DemoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Pos\CustomerController;
use App\Models\Supplier;
use App\Http\Controllers\Pos\SupplierController;


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

// customer All Route
Route::controller(CustomerController::class)->group(function () {
    Route::get('/Customer/All', 'CustomerAll')->name('customer.all');
    Route::get('/Customer/Add', 'CustomerAdd')->name('customer.add');
    Route::post('/Customer/store', 'CustomerStore')->name('customer.store');
    Route::get('/Customer/edit/{id}', 'CustomerEdit')->name('customer.edit');
    Route::post('/Customer/update', 'CustomerUpdate')->name('customer.update');
    Route::get('/Customer/delete/{id}', 'CustomerDelete')->name('customer.delete');

});

Route::get('/', function () {
    return view('admin.index');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';