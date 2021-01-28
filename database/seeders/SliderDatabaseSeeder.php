<?php

namespace Database\Seeders;
use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderDatabaseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Slider::factory()->count(5)->create();
  }
}
