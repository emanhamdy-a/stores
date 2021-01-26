<?php

namespace App\UploadImage;

use App\Models\Image;
use App\Models\Product;
use App\UploadImage\AbstractUploadImage;

class ProductImageStore extends AbstractUploadImage{

  public $disc  =null;
  public $folder=null;
  public $path;


  /**
   * save images to db
   */
  public function storeImages($image,$id){
    if(!Image::where('photo',$image)->first()){
      $newimage=Image::create([
        'product_id' => $id,
        'photo' => $image,
      ]);
      return $newimage->id;
    }
  }
  /**
   * delete product images
   */
  public function deleteimages($productId){
    if($product=Product::findOrFail($productId)){
      if(!empty($product->images)){
        foreach($product->images as $image){
          $filename=$image->photo;
          // delete image from folder
          $this->unlinkimage($filename);
          // delete image from database
          Image::where('photo',$filename)->delete();
        }
      }
    }
  }
  /**
   * delete one image
   */
  public function deleteImage($request){
    $image=Image::findOrFail($request->id);
    // delete image from folder
    $this->unlinkimage($image->photo);
    // delete image from database
    Image::where('photo',$image->photo)->delete();
    return response()->json([
      'status' => 200,
      'msg' => __('admin/products.product image deleted'),
    ]);
  }
}
