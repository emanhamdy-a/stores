<?php
namespace Database\Factories;
use App\Models\Picture;
use Illuminate\Database\Eloquent\Factories\Factory;
class PictureFactofy extends Factory
{
  protected $model = Picture::class;
  public function definition()
  {
    return [
      'filename' =>'',
      'pictureable_id' => '',
      'pictureable_type' => ' ',
    ];
  }
}
