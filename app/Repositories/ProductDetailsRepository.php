<?php


namespace App\Repositories;
use App\Models\Product;
use App\Models\Attribute;
use App\Http\Interfaces\ProductDetailsRepositoryInterface;

class ProductDetailsRepository implements ProductDetailsRepositoryInterface
{

  /**
   * get product attributes
   */
  public function ProductAttributes($product_id)
  {
    return Attribute::whereHas('options' , function ($q) use($product_id){
        $q -> whereHas('product',function ($qq) use($product_id){
        $qq -> where('product_id',$product_id);
      });
    })->get();
  }

  /**
   * get related products
   */
  public function relatedProducts($product_categories_ids)
  {
    return Product::whereHas('categories',function ($cat) use($product_categories_ids){
      $cat-> whereIn('categories.id',$product_categories_ids);
    }) -> limit(20) -> latest() -> get();
  }

}
