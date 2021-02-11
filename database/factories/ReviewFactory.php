<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Review::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $user_ids    = User::all()->pluck('id')->toArray();
    $product_ids = Product::all()->pluck('id')->toArray();

    return [
      'title' => $this->faker->text(50),
      'review' => $this->faker->numberBetween(0, 5) ,
      'content' => $this->faker->paragraph(),
      'user_id' => Arr::random($user_ids) ,
      'product_id' => Arr::random($product_ids) ,
    ];
  }
}
