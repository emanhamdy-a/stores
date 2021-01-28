<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\File;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Product::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $image = $this->faker->image(null,400,450,'product');
    $imageFile = new File($image);
    $manage_stock = $this->faker->boolean();
    $price = $this->faker->numberBetween(100, 9000);
    $rnd=$this->faker->numberBetween(1, 5);
    $brand_id = Brand::all()->pluck('id')->toArray();

    return [
      'name:ar' => $this->faker->text(60),
      'name:en' => $this->faker->text(60),
      'name:fr' => $this->faker->text(60),
      'name:es' => $this->faker->text(60),
      'description:ar' => $this->faker->paragraph(),
      'description:en' => $this->faker->paragraph(),
      'description:fr' => $this->faker->paragraph(),
      'description:es' => $this->faker->paragraph(),
      'short_description:ar' => $this->faker->paragraph(),
      'short_description:en' => $this->faker->paragraph(),
      'short_description:fr' => $this->faker->paragraph(),
      'short_description:es' => $this->faker->paragraph(),
      'main_image' => Storage::disk('products')->putFile(null, $imageFile),
      'qty' => $manage_stock ? $this->faker->numberBetween(1, 222) : null,
      'viewed' => $this->faker->numberBetween(0, 222),
      'manage_stock' => $manage_stock,
      'in_stock' => $this->faker->boolean(),
      'slug' => $this->faker->slug(),
      'sku' => $this->faker->word(),
      'is_active' => $this->faker->boolean(),
      'brand_id' => Arr::random($brand_id) ,
      'price' => $price,
      'special_price_type'
          => $rnd == 2 ? Arr::random(['precent','fixed']) : null,
      'special_price'
          => $rnd == 2 ? $price - 50 : null,
      'special_price_start'
          => $rnd == 2 ? $this->faker->dateTimeBetween('now') : null,
      'special_price_end'
          => $rnd == 2 ? $this->faker->dateTimeBetween('now', '+7 days') : null,
    ];
  }
}
