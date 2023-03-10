<?php

use App\Product;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SaveForLaterController;

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

Route::redirect('/', '/en');

Route::group(['prefix' => '{lang}'], function () {

    Route::get('/', [ProductController::class, 'index'])->name('landingPage');

    Route::get('/shop', [ShopController::class, 'index'])->name('shopIndex');
    Route::get('/shop/{product}', [ShopController::class, 'show'])->name('shopShow');

    Route::get('/cart', [CartController::class, 'index'])->name('cartIndex');
    Route::post('/cart', [CartController::class, 'store'])->name('cartStore');
    Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cartDestroy');
    Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cartUpdate');

    Route::post('/cart/switchToSaveForLater/{product}', [CartController::class, 'switchToSaveForLater'])->name('cartSwitchToSaveForLater');
    Route::delete('/saveForLater/{product}', [SaveForLaterController::class, 'destroy'])->name('saveForLaterDestroy');
    Route::post('/saveForLater/switchToCart/{product}', [SaveForLaterController::class, 'switchToCart'])->name('saveForLaterSwitchToCart');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkoutIndex')->middleware('auth');
    Route::get('/guestCheckout', [CheckoutController::class, 'index'])->name('guestCheckoutIndex')->middleware('guest');

    Route::post('/coupon', [CouponController::class, 'store'])->name('couponStore');
    Route::delete('/coupon', [CouponController::class, 'destroy'])->name('couponDestroy');

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/search', [ProductController::class, 'search'])->name('searchResults');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
