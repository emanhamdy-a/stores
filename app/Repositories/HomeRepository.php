<?php


namespace App\Repositories;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Http\Interfaces\HomeRepositoryInterface;

class HomeRepository implements HomeRepositoryInterface
{

  /**
   * get main slider
   */
  public function getMainSlider()
  {
    return Slider::get(['photo']);
  }

  /**
   * get flash deal
   */
  public function getFlashDeal()
  {
    return Product::where('special_price' , '!=' ,null)
    ->latest()->first() ?? Product::orderBy('price' , 'desc')->first();
  }

  /**
   * get new products
   */
  public function newProducts()
  {
    return Product::latest()->take(10)->get();
  }

  /**
   * get trends products
   */
  public function Trends()
  {
    return Product::orderBy('viewed' , 'desc')->take(30)->get();
  }

  /**
   * get best sellers
   */
  public function bestSellers()
  {
    return Product::where('special_price' , '!=' ,null)
    ->latest()->take(7)->get() ?? Product::orderBy('price' , 'desc')->take(7)->get();
  }

  /**
   * get main categories for products
   */
  public function mainCategoriesProdcuts()
  {
    return Category::parent()->take(6)->get();
  }

}
