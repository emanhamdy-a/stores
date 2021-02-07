<?php

namespace App\Http\Controllers\Site;


use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function home()
    {
      $data = [];

      // $data['sliders'] = Slider::all();
      $data['sliders'] = Slider::get(['photo']);

      $data['flash_deal'] = Product::where('special_price' , '!=' ,null)
        ->latest()->first() ?? Product::orderBy('price' , 'desc')->first();

      $data['newProducts'] = Product::latest()->take(10)->get();

      $data['trendes'] = Product::orderBy('viewed' , 'desc')->take(30)->get();

      $data['bestSellers'] = Product::where('special_price' , '!=' ,null)
      ->latest()->take(7)->get() ?? Product::orderBy('price' , 'desc')->take(7)->get();

      $data['main_categories_products'] = Category::parent()->take(6)->get();

      return view('front.home', $data);
    }
}
