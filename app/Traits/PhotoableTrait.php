<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait PhotoableTrait {

  public $disc   = null;
  public $folder = null;
  public $path;

  public function move_to_folder($request_image,$folder=null,$name=null){

    if(!$request_image){
      return false;
    }

    $data=[
      'size'      => $request_image->getSize(),
      'mimetype'  => $request_image->getMimeType(),
      'name'      => $request_image->getClientOriginalName(),
      'hashname'  => $request_image->hashName(),
      'extention' => $request_image->extension(),
    ];

    if(!$name){
      $this->path = Storage::disk($this->disc)->put($folder, $request_image);
    }else{
      $this->path = Storage::disk($this->disc)->putFileAs($folder, $request_image,$name.'.'.$data['extention']);

      $data['customname']=$name .'.'. $data['extention'];

    }

    $data['fullpath']=$this->path;
    return $data;

  }

  public function unlinkimage($filename,$folder=null){
    if($folder == null){
      Storage::disk($this->disc)
      ->has($filename)?Storage::disk($this->disc)
      ->delete($filename):'';
    }else{
      Storage::disk($this->disc)
      ->has($folder  .'/'. $filename)?Storage::disk($this->disc)
      ->delete($folder  .'/'. $filename):'';
    }
  }

}
