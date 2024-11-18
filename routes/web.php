<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

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
//Frontend
Route::get('/',[HomeController::class,'index']);
Route::get('/home',function(){
  return 'HomeController@index';
});
Route::post('/tim-kiem',function(){
  return 'HomeController@index';
});

//Show category and show brand
Route::get('/category-product/{product_id}',[CategoryProduct::class,'show_category']);
Route::get('/brand-product/{product_id}',[BrandProduct::class,'show_brand']);
Route::get('/product-details/{product_id}',[ProductController::class,'show_product_details']);

//Backend
Route::post('/admin',[AdminController::class,'index']);
Route::post('/dashboard',[AdminController::class,'show_dashboard']);
Route::get('/admin-dashboard',[AdminController::class,'dashboard']);
Route::post('/logout',[AdminController::class,'logout']);

//Category Products
Route::get('/add-category-product',[CategoryProduct::class,'add_category_product']);
Route::get('/all-category-product',[CategoryProduct::class,'all_category_product']);
Route::get('/edit-category-product/{$category_product_id}',[CategoryProduct::class,'edit_category_product']);
Route::post('/update-category-product/{category_product_id}',[CategoryProduct::class,'update_category_product']);
Route::post('/save-category-product',[CategoryProduct::class,'save_category_product']);
Route::get('/delete-category-product/{category_product_id}',[CategoryProduct::class,'delete_category_product']);
Route::get('/unactive-category-product/{category_product_id}',[CategoryProduct::class,'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}',[CategoryProduct::class,'active_category_product']);

//Brand Products
Route::get('/add-brand-product',[BrandProduct::class,'add_brand_product']);
Route::get('/all-brand-product',[BrandProduct::class,'all_brand_product']);
Route::get('/edit-brand-product/{brand_product_id}',[BrandProduct::class,'edit_brand_product']);
Route::get('/delete-brand-product/{brand_product_id}',[BrandProduct::class,'delete_brand_product']);
Route::get('/unactive-brand-product/{brand_product_id}',[BrandProduct::class,'unactive_brand_product']);
Route::get('/active-brand-product/{brand_product_id}',[BrandProduct::class,'active_brand_product']);
Route::post('/save-brand-product',[BrandProduct::class,'save_brand_product']);
Route::post('/update-brand-product/{brand_product_id}',[BrandProduct::class,'update_brand_product']);

//Products
Route::get('/add-product',[ProductController::class,'add_product']);
Route::get('/all-product',[ProductController::class,'all_product']);
Route::get('/edit-product/{product_id}',[ProductController::class,'edit_product']);
Route::get('/delete-product/{product_id}',[ProductController::class,'delete_product']);
Route::get('/unactive-product/{product_id}',[ProductController::class,'unactive_product']);
Route::get('/active-product/{product_id}',[ProductController::class,'active_product']);
Route::post('/save-product',[ProductController::class,'save_product']);
Route::post('/update-product/{product_id}',[ProductController::class,'update_product']);

//Cart
Route::post('/save-cart',[CartController::class,'save_cart']);
Route::get('/show-cart',[CartController::class,'show_cart']);
Route::get('/delete-to-cart/{rowId}',[CartController::class,'delete_to_cart']);
Route::get('/update-cart-quantity',[CartController::class,'update_cart_quantity']);


//Check-out
Route::get('/login-checkout',[CheckoutController::class,'login_checkout']);
Route::get('/logout-checkout',[CheckoutController::class,'logout_checkout']);
Route::post('/add-customer',['CheckoutController@add_customer']);
Route::post('/login-customer',['CheckoutController@login_customer']);
Route::post('/order_here',['CheckoutController@order_here']);
Route::get('/checkout',['CheckoutController@checkout']);
Route::get('/payment',['CheckoutController@payment']);
Route::post('/save-checkout-customer',['CheckoutController@save_checkout_customer']);