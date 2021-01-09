<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\VerificationCodeController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\WishlistController;
use App\Http\Controllers\Site\CartController;


Route::group([
  'prefix' => LaravelLocalization::setLocale(),
  'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {


  route::get('/', [HomeController::class,'home'])
    ->name('home');

  Route::group(['namespace'=>'Site'],
  function(){

    route::get('category/{slug}',[CategoryController::class,'productsBySlug'])
      ->name('category');
    route::get('product/{slug}', [ProductController::class,'productsBySlug'])
      ->name('product.details');

    Route::group(['prefix' => 'cart'], function () {
      Route::get('/', [CartController::class,'getIndex'])
        ->name('site.cart.index');
      Route::post('/cart/add/{slug?}', [CartController::class,'postAdd'])
        ->name('site.cart.add');
      Route::post('/update/{slug}', [CartController::class,'postUpdate'])
        ->name('site.cart.update');
      Route::post('/update-all', [CartController::class,'postUpdateAll'])
        ->name('site.cart.update-all');
    });

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

      Route::post('wishlist', [WishlistController::class,'store'])
        ->name('wishlist.store');
      Route::delete('wishlist', [WishlistController::class,'destroy'])
        ->name('wishlist.destroy');
      Route::get('wishlist/products', [WishlistController::class,'index'])
        ->name('wishlist.products.index');

    });


    // must be authenticated user and verified
    Route::group(['middleware' => 'verifyUser']
      , function () {
      Route::get('profile', function () {
          return 'You Are Authenticated ';
      });
    });

  });

  // guest

  Route::group(['namespace'=>'Site',
  'middleware'=>'guest','prefix'=>'site'],function(){

    Route::get('hi', function () {
      return 'Hello';
    });

  });

});
