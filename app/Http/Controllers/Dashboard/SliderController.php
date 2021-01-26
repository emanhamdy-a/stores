<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UploadImage\SlidersImageStore;
use App\Http\Requests\SliderImagesRequest;

class SliderController extends Controller
{

  protected $upload;

  public function __construct(SlidersImageStore $upload)
  {
    $this->upload       = $upload;
    $this->upload->disc ='sliders';
  }

  public function addImages()
  {
    $images = Slider::get(['id','photo']);
    return view('dashboard.sliders.images.create', compact('images'));
  }

  //to save images
  public function saveSliderImages(SliderImagesRequest $request)
  {

    $file = $request->file('dzfile');
    $data = $this->upload->move_to_folder($file);
    //store to db
    $fid  = $this->upload->storeImages($data['hashname'],null);
    return response()->json([
      'status' =>200,
      'msg' => __('admin/image.uploaded'),
      'fid' => $fid,
      'name' => $data['hashname'],
      'original_name' => $data['name'],
    ]);

  }

  /**
   * delete on image
   */
  public function deleteImage(Request $request){
    return $this->upload->deleteimage($request);
  }

}
