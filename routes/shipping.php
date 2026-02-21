<?php
use App\Http\Controllers\Admin\ShippingController;
use Illuminate\Support\Facades\Route;


Route::get('shipping',[ShippingController::class, 'index']);
Route::delete('shipping/{id}',[ShippingController::class, 'shipping_delete'])->name('delete_shipping');
Route::post('add/shipping',[ShippingController::class, 'shipping_store'])->name('admin.shipping.store');
Route::get('shipping/list',[ShippingController::class, 'Shipping_list']);
Route::post('shipping/update/{id}',[ShippingController::class, 'update_shipping'])->name('shipping.update');
Route::get('edit/shipoing/{id}',[ShippingController::class, 'shiping_edit'])->name('shipping.edit');
