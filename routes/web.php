<?php

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
//FRONTEND
Route::get('/', 'HomeController@index');
Route::get('/trang-chu', 'HomeController@index')->name('home');
Route::post('/tim-kiem', 'HomeController@search')->name('search');
Route::get('/contact-us', 'HomeController@contact')->name('contact');
Route::post('/send-mail', 'HomeController@send_mail')->name('send_mail');
//send-mail


//Danh mục sản phẩm
Route::get('/danh-muc-san-pham/{category_id}', 'CategoryProduct@show_category_home')->name('show_category_home');
Route::get('/danh-muc-thuong-hieu/{brand_id}', 'BrandProduct@show_brand_home')->name('show_brand_home');
Route::get('/chi-tiet-san-pham/{product_id}', 'ProductController@detail_product');

//Cart
Route::post('/save-cart', 'CartController@save_cart')->name('save_cart');
Route::get('/show-cart', 'CartController@show_cart')->name('show_cart');
Route::get('/delete-to-cart/{rowId}', 'CartController@delete_cart')->name('delete_cart');
Route::post('/quantity-update/{rowId}', 'CartController@quantity_update');

//checkout
Route::get('/login-checkout', 'CheckoutController@login_checkout')->name('login_checkout');

//customer
Route::post('/creat-customer', 'CheckoutController@creat_customer')->name('creat_customer');
Route::post('/customer-login', 'CheckoutController@customer_login')->name('customer_login');
Route::get('/checkout', 'CheckoutController@checkout')->name('checkout');

//shipping
Route::post('/save-shipping', 'CheckoutController@save_shippng');
//logout
Route::get('/logout-customer', 'CheckoutController@logout_customer');




//BACKEND

Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashboard');
Route::get('/logout', 'AdminController@logout')->name('logout');
Route::post('/admin-dashboard', 'AdminController@dashboard')->name('dashboard');

//CategoryProduct
Route::get('/add-category-product', 'CategoryProduct@add_category_product')->name('add_category_product');
Route::get('/all-category-product', 'CategoryProduct@all_category_product')->name('all_category_product');
Route::get('/unactive-category-product/{category_id}', 'CategoryProduct@unactive_category_product')->name('unactive_category_product');
Route::get('/active-category-product/{category_id}', 'CategoryProduct@active_category_product')->name('active_category_product');

Route::post('/save-category-product', 'CategoryProduct@save_category_product')->name('save_category_product');
Route::get('/edit-category-product/{category_id}', 'CategoryProduct@edit_category_product')->name('edit_category_product');
Route::post('/update-category-product/{category_id}', 'CategoryProduct@update_category_product')->name('update_category_product');

Route::get('/delete-category-product/{category_id}', 'CategoryProduct@delete_category_product')->name('delete_category_product');

//BrandProduct
Route::get('/add-brand', 'BrandProduct@add_brand')->name('add_brand');
Route::get('/all-brand', 'BrandProduct@all_brand')->name('all_brand');
Route::get('/unactive-brand/{brand_id}', 'BrandProduct@unactive_brand')->name('unactive_brand');
Route::get('/active-brand/{brand_id}', 'BrandProduct@active_brand')->name('active_brand');

Route::post('/save-brand', 'BrandProduct@save_brand')->name('save_brand');
Route::get('/edit-brand/{brand_id}', 'BrandProduct@edit_brand')->name('edit_brand');
Route::post('/update-brand/{brand_id}', 'BrandProduct@update_brand')->name('update_brand');

Route::get('/delete-brand/{brand_id}', 'CategoryProduct@delete_brand')->name('delete_brand');

//Product
Route::get('/add-product', 'ProductController@add_product')->name('add_product');
Route::get('/all-product', 'ProductController@all_product')->name('all_product');
Route::get('/unactive-product/{product_id}', 'ProductController@unactive_product')->name('unactive_product');
Route::get('/active-product/{product_id}', 'ProductController@active_product')->name('active_product');

Route::post('/save-product', 'ProductController@save_product')->name('save_product');
Route::get('/edit-product/{product_id}', 'ProductController@edit_product')->name('edit_product');
Route::post('/update-product/{product_id}', 'ProductController@update_product')->name('update_product');

Route::get('/delete-product/{product_id}', 'ProductController@delete_product')->name('delete_product');

//Order
Route::get('/manage-order', 'CheckoutController@manage_order')->name('manage_order');
Route::get('/view-order/{order_id}', 'CheckoutController@view_order')->name('view_order');
Route::get('/delete-order/{order_id}', 'CheckoutController@delete_order')->name('delete_order');

//Delivery
Route::get('/delivery', 'DeliveryController@delivery');
Route::post('/select-delivery', 'DeliveryController@select_delivery');
Route::post('/insert-delivery', 'DeliveryController@insert_delivery');
Route::post('/select-feeship', 'DeliveryController@select_feeship');
Route::post('/update-delivery', 'DeliveryController@update_delivery');
