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

      $data['sliders'] = Slider::get(['photo']);

      $data['flash_deal'] = Product::where('special_price' , '!=' ,null)
        ->latest()->first() ?? Product::orderBy('price' , 'desc')->first();

      $data['newProducts'] = Product::orderBy('id' , 'desc')->take(10);

      $data['trendes'] = Product::orderBy('viewed' , 'desc')->take(10);

      $data['bestSellers'] = Product::where('special_price' , '!=' ,null)
      ->latest()->take(10) ?? Product::orderBy('price' , 'desc')->take(10);

      $data['categories'] = Category::parent()->select('id', 'slug')->with(['childrens' => function ($q) {
         $q->select('id', 'parent_id', 'slug');
         $q->with(['childrens' => function ($qq) {
            $qq->select('id', 'parent_id', 'slug');
         }]);
      }])->get();

      return view('front.home', $data);
    }
}
