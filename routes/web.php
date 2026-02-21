<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FormDataController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\VenueController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('admin', [AdminController::class, 'login_admin']);
Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::get('admin/store', [LoginController::class, 'store'])->name('login.store');
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::middleware(['admin'])->group(function () {
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('category', [ProductController::class, 'show_cate'])->name('category');
    Route::delete('category/delete/{id}', [ProductController::class, 'category_delete'])->name('category.delete');
    Route::get('category/edit/{id}', [ProductController::class, 'category_edit'])->name('category.edit');
    Route::post('category/update/{id}', [ProductController::class, 'category_update'])->name('category.update');
    Route::get('list/category', [ProductController::class, 'category_list'])->name('category.listing');
    Route::post('add/product/category', [ProductController::class, 'category_add'])->name('admin.categories.store');
    Route::get('products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('products/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::post('products/update/{id}', [ProductController::class, 'product_update'])->name('admin.product.update');
    Route::get('/product/list', [ProductController::class, 'product_list'])->name('poducts.listing');
    Route::get('/products/add', [ProductController::class, 'create'])->name('admin.venue.add');
    Route::get('product/edit/{id}', [ProductController::class, 'edit_product'])->name('product.edit');
    Route::delete('product/delete/{id}', [ProductController::class, 'delete_product'])->name('product.delete');
    Route::get('/venue/{id}/edit', [VenueController::class, 'edit'])->name('admin.venue.edit');
    Route::put('/venue/{id}', [VenueController::class, 'update'])->name('admin.update');
    Route::delete('/venue/{id}', [VenueController::class, 'destroy'])->name('admin.venue.destroy');
    Route::get('/vendors/create', [VendorController::class, 'create'])->name('admin.vendors.create');
    Route::post('/vendors/add', [VendorController::class, 'store'])->name('admin.vendors.store');
    Route::get('/vendors', [VendorController::class, 'index'])->name('admin.vendors.index');   // List vendors
    Route::get('/vendors/{vendor}/edit', [VendorController::class, 'edit'])->name('admin.vendors.edit'); // Edit form
    Route::put('/vendors/{vendors}', [VendorController::class, 'update'])->name('admin.vendors.update');  // Update vendor
    Route::get('/vendorsRegistration', [FormDataController::class, 'indexVendors'])->name('admin.vendorsreg.index');
    Route::get('/contacts', [FormDataController::class, 'indexContacts'])->name('admin.contacts.index');
    Route::get('/meetings', [FormDataController::class, 'indexMeetings'])->name('admin.meetings.index');
    Route::get('/list/users',[ProductController::class, 'listUsers']);
    Route::get('/list/order',[ProductController::class, 'listOrder']);
    Route::get('offer',[ProductController::class, 'offer']);
    Route::post('add/offer',[HomeController::class, 'addOffer'])->name('admin.coupons.store');

    // Admin Dashboard
    // Route::get('admin/dashboard', function () {
    //     return view('admin.dashboard');
    // })->name('dashboard');

    // Users List
    Route::get('/users', function () {
        return 'This is the admin users list';
    })->name('users');

    // Settings Page
    Route::get('/settings', function () {
        return 'Admin settings page';
    })->name('settings');
});


//end adm9in section 


Route::get('/', function () {
    return view('home');
});
// 
Route::get('about', [HomeController::class, 'about'])->name('about');

Route::get('product', [HomeController::class, 'product'])->name('product');

Route::get('cart', [HomeController::class, 'cart'])->name('cart');

Route::get('productdetails/{slug}', [HomeController::class, 'productdetails'])->name('productdetails');

Route::get('contact', [HomeController::class, 'contact'])->name('contact');// products-pages
Route::get('product-details', [HomeController::class, 'product-details'])->name('product-details');
Route::post('/store',[HomeController::class, 'store']);
Route::post('/login',[HomeController::class, 'login_user'])->name('user.login');
Route::get('/logout',[HomeController::class, 'logout'])->name('user.logout');
Route::post('save/aaddess',[HomeController::class, 'add_address'])->name('add.address');
// Route::delete('cart/delete/{id}',[HomeController::class, 'cartDelete'])->name('cart.delete');
// Route::post('/cart/update-quantity', [HomeController::class, 'updateQuantity'])->name('cart.update');
Route::post('/cart/add', [HomeController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update-quantity', [HomeController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::get('/cart/delete/{id}', [HomeController::class, 'delete'])->name('cart.delete');
Route::post('/add/promo_code',[HomeController::class, 'applyCoupon'])->name('apply.promo');
Route::post('order/confirm',[HomeController::class, 'orderConfirm'])->name('order.confirm');
Route::get('forget-pass',[HomeController::class, 'forgetpassword_email'])->name('forget.password');
Route::get('search', [HomeController::class, 'searchproduct'])->name('product.search');
Route::get('get_forgetpass',[HomeController::class,'get_forget'])->name('get.forget.pass');
Route::post('reset/password',[HomeController::class, 'resetPassword'])->name('reset.password');
Route::post('buy/now', [HomeController::class, 'BuyNow'])->name('buy.now');
Route::get('thanks',[HomeController::class,'thanks']);
Route::post('contact',[HomeController::class, 'contactUs'])->name('contact.me');
Route::get('contactget',[FormDataController::class,'contactget']);