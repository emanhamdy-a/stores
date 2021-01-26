<?php

namespace App\UploadImage;

use App\Models\Slider;
use App\UploadImage\AbstractUploadImage;

class SlidersImageStore extends AbstractUploadImage{

  public $disc  =null;
  public $folder=null;
  public $path;


  /**
   * save images to db
   */
  public function storeImages($image,$id){
    if(!Slider::where('photo',$image)->first()){
      $newimage=Slider::create([
        'photo' => $image,
      ]);
      return $newimage->id;
    }
  }
  /**
   * delete product images
   */
  public function deleteimages($productId){

  }
  /**
   * delete one image
   */
  public function deleteImage($request){
    $image=Slider::findOrFail($request->id);
    // delete image from folder
    $this->unlinkimage($image->photo);
    // delete image from database
    Slider::where('photo',$image->photo)->delete();
    return response()->json([
      'status' => 200,
      'msg' => __('admin/sliders.image deleted'),
    ]);
  }
}
