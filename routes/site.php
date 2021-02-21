<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\OrdersController;
use App\Http\Controllers\Site\SearchController;
use App\Http\Controllers\Site\PaymentController;
use App\Http\Controllers\Site\ProductController;
// use App\Http\Controllers\Site\ProductReviewController;
use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\WishlistController;
use App\Http\Controllers\Site\ProductReviewController;
use App\Http\Controllers\Site\VerificationCodeController;
use App\Http\Controllers\Site\UpdateUserProfileController;


Route::group([
  'prefix' => LaravelLocalization::setLocale(),
  'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {


  Route::group(['namespace'=>'Site'],
  function(){

    route::get('/', [HomeController::class,'home'])
      ->name('home');

    route::get('/search', [SearchController::class,'search'])
      ->name('search');

    route::get('category/{slug}',[CategoryController::class,'productsBySlug'])
      ->name('category');
    route::get('product/{slug}', [ProductController::class,'productsBySlug'])
      ->name('product.details');

    // must be authenticated user
    Route::group(['middleware'=>'auth'],  function(){

      Route::get('/verify', function () {
        return view('auth.verification');
      });

      Route::post('verify-user/',
        [VerificationCodeController::class ,'verify'])
        ->name('verify-user');
      Route::get('verify',
        [VerificationCodeController::class ,'getVerifyPage'])
        ->name('get.verification.form');

      Route::group(['prefix' => 'cart'], function () {
        Route::get('/', [CartController::class,'getIndex'])
          ->name('site.cart.index');
        Route::get('/add/{slug?}', [CartController::class,'postAdd'])
          ->name('site.cart.add');
        Route::post('/add/{slug?}', [CartController::class,'postAdd'])
          ->name('site.cart.add');
        Route::post('/update/{slug?}', [CartController::class,'postUpdate'])
          ->name('site.cart.update');
        Route::post('/update-all', [CartController::class,'postUpdateAll'])
          ->name('site.cart.update-all');
      });

      Route::group(['prefix' => 'wishlist'], function () {
        Route::post('/', [WishlistController::class,'store'])
          ->name('wishlist.store');
        Route::delete('/', [WishlistController::class,'destroy'])
          ->name('wishlist.destroy');
        Route::get('products', [WishlistController::class,'index'])
          ->name('wishlist.products.index');
      });

      Route::group(['prefix' => 'reviews'], function () {
        // Route::get('/{productId}/reviews',  [ProductReviewController::class,'index'])
        //   ->name('products.reviews.index');
        Route::post('/store',[ProductReviewController::class,'store'])
          ->name('products.reviews.store');
      });

      Route::group(['prefix' => 'payment'], function () {
        Route::get('/{amount}', [PaymentController::class,'getPayments'])
        -> name('payment');
        Route::post('/', [PaymentController::class,'processPayment'])
        -> name('payment.process');
      });

      Route::get('orders',[OrdersController::Class,'index'])->name('orders');

    });


    // must be authenticated user and verified
    Route::group(['middleware' => 'verifyUser'], function () {
      Route::get('profile', function () {
        return view('auth.profile');
      })->name('profile');
      Route::post('profile', [UpdateUserProfileController::class,'update'])
        ->name('edit.profile');
    });

  });

  // guest

  Route::group(['namespace'=>'Site', 'middleware'=>'guest','prefix'=>'site']
    ,function(){

    Route::get('hi', function () {
      return 'Hello';
    });

  });

});
