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

Route::get('/','Customer\ProductController@home');
Route::get('/search/all-products','Customer\ProductController@showAllProduct');
Route::get('/search', 'Customer\ProductController@search');
Route::get('/about-us','Customer\HomeController@showAbout');
Route::get('/product/{id}', 'Customer\ProductController@index');
Route::get('province','Customer\AddressController@getProvinces');
Route::get('city','Customer\AddressController@getCity');
Route::get('barangay','Customer\AddressController@getBarangay');

Route::group(['prefix' => 'customer'], function () { 
  
  Route::get('/login', 'CustomerAuth\LoginController@showLoginForm')->name('customer.login');
  Route::post('/login', 'CustomerAuth\LoginController@login');
  Route::post('/logout', 'CustomerAuth\LoginController@logout')->name('customer.logout');

  Route::get('/register', 'CustomerAuth\RegisterController@showRegistrationForm')->name('customer.register');
  Route::post('/register', 'CustomerAuth\RegisterController@register');

  Route::post('/password/email', 'CustomerAuth\ForgotPasswordController@sendResetLinkEmail')->name('customer.password.request');
  Route::post('/password/reset', 'CustomerAuth\ResetPasswordController@reset')->name('customer.password.email');
  Route::get('/password/reset', 'CustomerAuth\ForgotPasswordController@showLinkRequestForm')->name('customer.password.reset');
  Route::get('/password/reset/{token}', 'CustomerAuth\ResetPasswordController@showResetForm');
  
  Route::get('/profile/{id}', 'Customer\CustomerController@profile')->middleware('auth:customer');
  Route::get('/profile/{id}/update-profile', 'Customer\CustomerController@showUpdateProfile')->middleware('auth:customer');
  Route::post('/profile/{id}/update-profile', 'Customer\CustomerController@updateProfile')->middleware('auth:customer');

  Route::get('/profile/{id}/order','Customer\CustomerController@showOrder');
  Route::get('/profile/{id}/order/{receipt_id}','Customer\CustomerController@showCustomerOrder');

  Route::post('product/{id}/add-to-cart/','Customer\CartController@addToCart')->middleware('auth:customer');
  Route::get('{id}/cart','Customer\CartController@showCart')->middleware('auth:customer');
  Route::post('{id}/cart/update','Customer\CartController@updateCart')->middleware('auth:customer');
  Route::post('{id}/cart/remove','Customer\CartController@removeCart')->middleware('auth:customer');

  Route::post('{id}/checkout','Customer\CheckoutController@index')->middleware('auth:customer');
  Route::post('{id}/checkout/place-order','Customer\CheckoutController@store')->middleware('auth:customer');

  Route::get('{id}/address/', 'Customer\AddressController@showAddress')->middleware('auth:customer');
  Route::get('{id}/address/new-address/', 'Customer\AddressController@showNewAddress')->middleware('auth:customer');
  Route::post('{id}/address/new-address/', 'Customer\AddressController@newAddress')->middleware('auth:customer');
  Route::get('{id}/address/{address_id}', 'Customer\AddressController@showUpdateAddress')->middleware('auth:customer');
  Route::post('{id}/address/{address_id}', 'Customer\AddressController@updateAddress')->middleware('auth:customer');

});

Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');


  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('admin.password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');

  Route::get('/category','Admin\CategoryController@index')->middleware('auth:admin');
  Route::get('/category/new-category','Admin\CategoryController@showNewCategory')->middleware('auth:admin');
  Route::post('/category/new-category','Admin\CategoryController@store')->middleware('auth:admin');
  Route::post('/category/update-category/{id}','Admin\CategoryController@update')->middleware('auth:admin');
  Route::delete('/category/{id}','Admin\CategoryController@destroy')->middleware('auth:admin');
  Route::get('/category/{id}','Admin\CategoryController@show')->middleware('auth:admin');

  Route::get('/manufacturer','Admin\ManufacturerController@index')->middleware('auth:admin');
  Route::get('/manufacturer/new-manufacturer','Admin\ManufacturerController@showNewManufacturer')->middleware('auth:admin');
  Route::post('/manufacturer/new-manufacturer','Admin\ManufacturerController@store')->middleware('auth:admin');
  Route::get('/manufacturer/{id}','Admin\ManufacturerController@show')->middleware('auth:admin');
  Route::delete('/manufacturer/{id}','Admin\ManufacturerController@destroy')->middleware('auth:admin');
  Route::post('/manufacturer/update-manufacturer/{id}','Admin\ManufacturerController@update')->middleware('auth:admin');

  Route::get('/products','Admin\ProductController@index')->middleware('auth:admin');
  Route::get('/products/new-product','Admin\ProductController@showNewProduct')->middleware('auth:admin');
  Route::post('products/new-product','Admin\ProductController@store')->middleware('auth:admin');
  Route::get('/products/{id}','Admin\ProductController@show')->middleware('auth:admin');
  Route::delete('/products/{id}','Admin\ProductController@destroy')->middleware('auth:admin');
  Route::post('/products/product-update/{id}','Admin\ProductController@update')->middleware('auth:admin');
  Route::post('/products/delete-image/{id}','Admin\ProductController@destroyImage')->middleware('auth:admin');

  Route::get('/customers','Admin\CustomerController@index')->middleware('auth:admin');

  Route::get('/orders','Admin\OrderController@showCustomersOrder')->middleware('auth:admin');
  Route::get('/orders/{receipt_id}','Admin\OrderController@showOrder')->middleware('auth:admin');
  Route::post('/orders/{receipt_id}','Admin\OrderController@addOrderHistory')->middleware('auth:admin');
  Route::get('/orders/{receipt_id}/delete/{history_id}','Admin\OrderController@deleteOrderHistory')->middleware('auth:admin');

  Route::get('/employees','Admin\EmployeeController@index')->middleware('auth:admin');
  Route::post('/employees/update-status/{id}','Admin\EmployeeController@changeStatus')->middleware('auth:admin');
  Route::get('/employees/{id}','Admin\EmployeeController@showEmployee')->middleware('auth:admin');
  Route::post('/employees/{id}','Admin\EmployeeController@updateEmployee')->middleware('auth:admin');
  Route::get('/new-employee','Admin\EmployeeController@showRegister');
  Route::post('/new-employee','Admin\EmployeeController@register');

  Route::get('/shipping','Admin\ShippingController@index')->middleware('auth:admin');
  Route::post('/shipping','Admin\ShippingController@store')->middleware('auth:admin');
});

