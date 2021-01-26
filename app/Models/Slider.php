<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['photo', 'created_at', 'updated_at'];

  public function imagePath($val)
  {
    return $val ? asset('images/sliders/'.$val) : '';
  }

}
