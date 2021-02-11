<?php


namespace App\Http\Interfaces;

interface ProductDetailsRepositoryInterface
{

  /**
   * get product attributes
   */
  public function ProductAttributes($product_id);

  /**
   * get related products
   */
  public function relatedProducts($product_categories_ids);

}
