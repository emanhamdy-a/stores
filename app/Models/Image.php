<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
  use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'photo', 'created_at', 'updated_at'];

    //


    // public function getPhotoAttribute($val)
    // {
    //     return $val ? asset('images/products/'.$val) : '';
    // }

}
