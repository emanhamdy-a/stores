<?php

namespace App\Models;
use App\Models\Product;
use App\Models\Photo;
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
        return  $this -> is_active  == 0 ?  'غير مفعل'   : 'مفعل' ;
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }

    public function img(){
      return \App\Models\Photo::where('photoable_id',$this -> id)
      ->where('photoable_type','App\Models\Brand')
      ->first();
    }
    public function photo()
    {
      return $this->morphOne('App\Models\Photo', 'photoable');
    }
}
