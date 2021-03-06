<?php

namespace App\Models;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use phpDocumentor\Reflection\Types\Self_;

class Brand extends Model
{
  use Translatable,HasFactory;
  /**
   * The relations to eager load on every query.
   *
   * @var array
   */
  protected $with = ['translations'];
  protected $translatedAttributes = ['name'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['is_active'];
  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'is_active' => 'boolean',
  ];

  public function scopeActive($query){
    return $query -> where('is_active',1) ;
  }

  public function getActive(){
    return  $this -> is_active  == 0 ? __('admin/brands.not active') : __('admin/brands.active');
  }

  public function products()
  {
    return $this->hasMany(Product::class, 'brand_id');
  }

  public function picture()
  {
    return $this->morphOne(Picture::class, 'pictureable');
  }

  // public function photo()
  // {
  //   return $this->morphOne(Photo::class, 'photoable');
  // }
}
