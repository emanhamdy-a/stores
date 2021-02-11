<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Repositories\ProductDetailsRepository;

class ProductController extends Controller
{
  protected $repository;

  public function __construct(ProductDetailsRepository $repository)
  {
    $this->repository = $repository;
  }

  public function productsBySlug($slug)
  {
    $data=[];

    $data['product'] = Product::where('slug',$slug)->first();

    if (!$data['product']){
       return redirect()->back()
      ->with(['error' =>
      __('front\product_details.error try later')]);
    }

    $product_id = $data['product'] -> id ;
    $product_categories_ids =  $data['product'] -> categories ->pluck('id');

     $data['product_attributes']=$this->repository->ProductAttributes($product_id);

     $data['related_products'] = $this->repository->relatedProducts($product_categories_ids);

    return view('front.products-details', $data);
  }

}
