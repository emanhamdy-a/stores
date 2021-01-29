<?php

namespace App\Models;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use phpDocumentor\Reflection\Types\Self_;

class Category extends Model
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
  protected $fillable = ['parent_id', 'slug', 'is_active'];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array
   */
  protected $hidden = ['translations'];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
   'is_active' => 'boolean',
  ];

  public function photo()
  {
    return $this->morphOne(Photo::class, 'photoable');
  }

  public function scopeParent($query){
    return $query -> whereNull('parent_id');
  }

  public function scopeChild($query){
    return $query -> whereNotNull('parent_id');
  }

  public function getActive(){
    return  $this -> is_active  == 0 ?  __('admin/categories.not active') : __('admin/categories.active') ;
  }

  public function _parent(){
    return $this->belongsTo(self::class, 'parent_id');
  }

  public function scopeActive($query){
    return $query -> where('is_active',1) ;
  }

  //get all childrens=
  public function childrens(){
    return $this -> hasMany(Self::class,'parent_id');
  }

  public function products()
  {
    return $this -> belongsToMany(Product::class,'product_categories');
  }

}
