<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController;


// Route::get('test', function () {
//   $category =  \App\Models\Category::with('trees')->find(35);
//    return $category;
// });

// Auth::routes();

Route::get('/home', [HomeController::class,'home'])
  ->name('home');

