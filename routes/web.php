<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\FrontendController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Front\WelcomeController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Front\WishlistController;
use App\Http\Controllers\Front\RatingController;
use App\Http\Controllers\Front\ReviewController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[WelcomeController::class,'index'])->name('welcome');
Route::get('/category',[WelcomeController::class,'category'])->name('category');
Route::get('/viewCategory/{slug}',[WelcomeController::class,'viewCategory'])->name('viewCategory');
Route::get('/viewCategory/{slug}/{productSlug}',[WelcomeController::class,'viewproduct']);
Route::get('/product_list',[WelcomeController::class,'productList']);
Route::post('searchProduct',[WelcomeController::class,'searchProduct'])->name('searchProduct');

Auth::routes();
Route::post('add-to-cart',[CartController::class,'addProduct']);
Route::post('delete_button',[CartController::class,'deleteProduct']);
Route::post('update-cart',[CartController::class,'updateProduct']);
Route::post('add-to-wishlist',[WishlistController::class,'add']);
Route::post('delete_wishlist',[WishlistController::class,'deleteItem']);
Route::get('load-cart-data',[CartController::class,'loadCart']);
Route::get('load-wish-data',[WishlistController::class,'loadWish']);


Route::middleware(['auth'])->group(function(){
Route::get('cart',[CartController::class,'viewCart'])->name('cart');
Route::get('checkout',[CheckoutController::class,'index'])->name('checkout');
Route::post('placeOrder',[CheckoutController::class,'placeOrder'])->name('place-order');
Route::get('my-orders',[UserController::class,'index'])->name('my-orders');
Route::get('my-order/{id}',[UserController::class,'view'])->name('my-order');
Route::get('wishlist',[WishlistController::class,'index'])->name('wishlist');
Route::post('procced-to-pay',[CheckoutController::class,'pay']);
Route::post('add-rating',[RatingController::class,'add'])->name('add-rating');
Route::get('add-review/{product_slug}/userreview',[ReviewController::class,'add']);
Route::post('addReview',[ReviewController::class,'Create'])->name('addReview');
Route::get('edit-review/{product_slug}/userreview',[ReviewController::class,'edit']);
Route::PUT('updateReview',[ReviewController::class,'update'])->name('updateReview');


});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard', [FrontendController::class, 'index'])->name('dashboard');


    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);
    Route::get('order-history',[OrderController::class,'orderHistory'])->name('order-history');
    Route::get('user',[DashboardController::class,'user'])->name('user');
    Route::get('update-user/{id}',[DashboardController::class,'viewUser'])->name('update-user');
});
