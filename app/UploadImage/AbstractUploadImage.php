<?php

namespace App\UploadImage;

abstract class AbstractUploadImage{

  public $folder;
  public $disc;
  /**
   * move image
   */
  public abstract function move($request_image);
  /**
   * store image to data base
   */
  public abstract function store($data);
  /**
   * update image in database
   */
  public abstract function update($data,$id);
  /**
   * delete image in data base
   */
  public abstract function delete($id);
}
