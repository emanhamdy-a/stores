<?php


namespace App\Repositories;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Interfaces\SearchRepositoryInterface;

class SearchRepository implements SearchRepositoryInterface
{

  /*
   * get search results
   */
  public function search($request)
  {
    $id_category  = $request ->id_category != '0' ? [$request ->id_category] : Category::pluck('id');
    $search_query = $request ->search_query;
    $orderby      = $request ->orderby  ?? 'id';
    $orderway     = $request ->orderway ?? 'desc';

    $products = DB::table('products')
    ->join('product_translations', 'products.id', '=', 'product_translations.product_id')
    ->join('product_categories', 'products.id', '=',
      'product_categories.product_id')
    ->where(function($query)use ($id_category){
      $query->whereIn('product_categories.category_id',$id_category);
    })
    ->where(function($query)use ($search_query){
      $query->where('product_translations.name','LIKE','%'.$search_query.'%')
      ->where('product_translations.locale',getLang());
      $query->orwhere('product_translations.description','LIKE','%'.$search_query.'%')
      ->where('product_translations.locale',getLang());
    })
    ->select('products.*')
    ->orderby($orderby,$orderway)
    ->paginate(PAGINATION_SEARCH);

    $hydrated = Product::hydrate($products->items());
    return $products->setCollection($hydrated);
  }

}
