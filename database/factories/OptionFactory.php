<?php

namespace Database\Factories;

use App\Models\Option;
use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class OptionFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Option::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $product   =  Product::all()->random()->id;
    $attribute =  Attribute::all()->random()->id;
    return [
      'name:ar'      => $this->faker->word(),
      'name:en'      => $this->faker->word(),
      'name:fr'      => $this->faker->word(),
      'name:es'      => $this->faker->word(),
      'attribute_id' => $attribute,
      'product_id'   => $product,
      'price'        => $this->faker->numberBetween(1, 222),
    ];
  }
}
