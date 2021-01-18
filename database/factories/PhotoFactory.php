<?php
namespace Database\Factories;
use Illuminate\Http\File;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;
class PhotoFactory extends Factory
{
  protected $model = Photo::class;
  public function definition()
  {
    // $image = $this->faker->image();
    // $imageFile = new File($image);
    return [
      'filename' =>'',//Storage::disk('public')->putFile('images', $imageFile),
      'photoable_id' => '',
      'photoable_type' => ' ',
    ];
  }
}
