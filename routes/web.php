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

Route::get('/home/payment','App\Http\Controllers\Frontend\IndexController@home');

Route::get('/', 'App\Http\Controllers\Frontend\IndexController@index');
Route::get('/detail-kambing/{id}', 'App\Http\Controllers\Frontend\IndexController@detail')->name('detail.kambing');

// login google
Route::get('auth/google', 'App\Http\Controllers\Frontend\IndexController@redirectToGoogle')->name('google.login');
Route::get('auth/google/callback/', 'App\Http\Controllers\Frontend\IndexController@handleGoogleCallback');

Route::post('/notification/handler', 'App\Http\Controllers\Frontend\CheckoutController@notificationHandler');

Route::post('logged_in', 'App\Http\Controllers\LoginController@authenticate')->name('logged_in');
Route::post('register_in', 'App\Http\Controllers\LoginController@register_in')->name('register_in');

Route::get('verify', 'App\Http\Controllers\Frontend\IndexController@verify')->name('signup.verify'); 


Route::group(['middleware' => ['auth']], function () {

Route::get('history', 'App\Http\Controllers\Frontend\IndexController@history')->name('history');


Route::get('/checkout', 'App\Http\Controllers\Frontend\IndexController@checkoutForm')->name('checkout.form');
Route::get('checkout/getKota/{id}', 'App\Http\Controllers\Frontend\IndexController@getKota');
Route::get('checkout/getKecamatan/{id}', 'App\Http\Controllers\Frontend\IndexController@getKecamatan');
Route::get('checkout/getDesa/{id}', 'App\Http\Controllers\Frontend\IndexController@getDesa');

// checkout 
Route::post('/alamat/store', 'App\Http\Controllers\Frontend\CheckoutController@storeAlamat')->name('alamat.store');
Route::post('/checkout/store', 'App\Http\Controllers\Frontend\CheckoutController@store')->name('checkout.store');
Route::post('/cart/store', 'App\Http\Controllers\Frontend\CheckoutController@storeCart')->name('cart.store');
Route::post('/checkout', 'App\Http\Controllers\Frontend\CheckoutController@checkout')->name('checkout');
Route::post('/checkout/live', 'App\Http\Controllers\Frontend\CheckoutController@checkoutLive')->name('checkout.live');
Route::post('checkout/payment', 'App\Http\Controllers\Frontend\CheckoutController@submitpayment')->name('checkout.submitpayment');

// cek cart
Route::get('check/cart', 'App\Http\Controllers\Frontend\IndexController@getCart')->name('cart.check');
Route::get('cart/count', 'App\Http\Controllers\Frontend\IndexController@countCart')->name('cart.count');

Route::get('check/delete', 'App\Http\Controllers\Frontend\IndexController@delete')->name('cart.delete');
Route::get('check/deleteAll', 'App\Http\Controllers\Frontend\IndexController@deleteAll')->name('cart.deleteAll');

});

// success midtrans
Route::post('/transaksi/sukses', function () {
    return view('frontend.success');
})->name('transaksi.success');

// register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::post('/finish', function(){
    return redirect()->route('welcome');
})->name('donation.finish');



Route::get('/cache/clear', function () {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
    return 'DONE'; //Return anything
});