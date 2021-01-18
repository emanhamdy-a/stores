<?php

namespace App\UploadImage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\UploadImage\AbstractUploadImage;

class LocalStorage extends AbstractUploadImage{

  protected $model;
  public function __construt(Model $model){
    $this->model=$model;
  }

  public function move($request_image,$folder=null,$name=null){

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

  public function store($data){

  }

  public function update($data,$id){
    $record = $this->model->findOrfail($id);
    if($record){
      return $this->record->save($data);
    }else{
      return false;
    }
  }

  public function delete($id){
    $record = $this->model->findOrfail($id);
    if($record){
      $filename=$record->filename;
      $record->delete();
      return $filename=$record->filename;
    }
    return false;
  }

  public function unlinkimage($filename,$folder=null){

    Storage::disk($this->disc)
    ->has($filename)?Storage::disk($this->disc)
    ->delete($filename):'';
  }

}
