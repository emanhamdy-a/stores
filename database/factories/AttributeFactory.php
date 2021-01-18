<?php

namespace Database\Factories;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Attribute::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'name:ar' => $this->faker->word(),
      'name:en' => $this->faker->word(),
      'name:fr' => $this->faker->word(),
      'name:es' => $this->faker->word(),
    ];
  }
}
