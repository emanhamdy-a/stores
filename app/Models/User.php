<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'password','mobile',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
      'email_verified_at' => 'datetime',
  ];

  public  function reviews(){
    return $this->hasMany(Review::class,'user_id');
  }

  public function codes() {
    return $this -> hasMany(User_verfication::class,'user_id');
  }

  public function wishlist() {
    return $this -> belongsToMany(Product::class,'wish_lists')
      ->withTimestamps();
  }

  public function wishlistHas($productId) {
    return Self::wishlist()->where('product_id',$productId)->exists();
  }

  public function orders(){
    return $this -> hasMany(Order::class,'customer_id');
  }
}
