<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductBookingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use App\Models\ProductBooking;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function() {
	Artisan::call('cache:clear');
	Artisan::call('config:clear');
	Artisan::call('config:cache');
	Artisan::call('view:clear');
	return "Cache is cleared";
});
Route::get('product/bookingSuccess',[ProductBookingController::class,'bookingSuccess'])->name('product.bookingSuccess');
Route::get('product/bookingFail',[ProductBookingController::class,'bookingFail'])->name('Product.bookingFail');

Route::post('product/booking',[ProductBookingController ::class,'store'])->name('product.booking');
Route::get('cart/delete',[CartController::class,'destroy'])->name('cart.delete');
Route::post('cart/store',[CartController::class,'store'])->name('cart.store');
Route::post('/user/login/user', [BaseController::class, 'logincheck'])->name('logincheck');
Route::get('/user/login', [BaseController::class, 'user_log'])->name('user.login');
Route::post('/user/submit', [BaseController::class, 'user_store'])->name('user.store');
Route::get('/user/submit', [BaseController::class, 'logout'])->name('user.logout');

Route::get('/', [BaseController::class, 'home'])->name('home');
Route::get('/home', [BaseController::class, 'home'])->name('home');

Route::get('/specialOffer', [BaseController::class, 'specialOffer'])->name('specialOffer');

Route::get('/delivery', [BaseController::class, 'delivery'])->name('delivery');
Route::get('/contact', [BaseController::class, 'contact'])->name('contact');
Route::get('/cart', [BaseController::class, 'cart'])->name('cart');

Route::get('/productView/{id}', [BaseController::class, 'productView'])->name('productView');
Route::get('/admin/login', [AdminController::class, 'login'])->name('login');

Route::post('/admin/login', [AdminController::class, 'makelogin'])->name('admin.makelogin');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    /*categoery*/
    Route::get('/category/add', [CategoryController::class, 'create'])->name('category.create');

    Route::post('/category/add', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.list');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/edit/{id}', [CategoryController::class, 'update'])->name('category.update');
    //Route::post('/category/update/{id}',[CategoryController::class,'edit'])->name('category.edit');
    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    //product
    Route::get('/products', [ProductController::class, 'index'])->name('product.list');
    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/edit/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
    Route::get('/product/details/{id}', [ProductController::class, 'extraDetails'])->name('product.extraDetails');
    Route::post('/product/details/{id}', [ProductController::class, 'extraDetailsStore'])->name('product.extraDetailsStore');
    Route::get('admin/users',[UserController::class,'index'])->name('admin.login');
    Route::get('/admin/users{id}', [UserController::class, 'destroy'])->name('user.delete');
    Route::get('booking/products',[ProductBookingController::class,'index'])->name('booking.products');
    Route::get('booking/delete/{id}',[ProductBookingController::class,'destroy'])->name('booking.delete');
    Route::get('booking/product-status',[ProductBookingController::class,'change_bookingstatus'])->name('booking.product.status');
    


});
