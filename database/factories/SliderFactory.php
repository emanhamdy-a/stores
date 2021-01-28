<?php
namespace Database\Factories;
use App\Models\Slider;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
  protected $model = Slider::class;
  public function definition()
  {
    $image = $this->faker->image(null,700,550,'sliders');
    $imageFile = new File($image);
    return [
      'photo' =>Storage::disk('sliders')->putFile(null, $imageFile),
    ];
  }
}
