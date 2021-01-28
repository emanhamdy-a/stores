<?php
namespace Database\Factories;
use App\Models\Image;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
  protected $model = Image::class;
  public function definition()
  {
    $image = $this->faker->image(null,400,480,'product');
    $imageFile = new File($image);
    return [
      'photo' =>Storage::disk('products')->putFile(null, $imageFile),
      'product_id' => '',
    ];
  }
}
