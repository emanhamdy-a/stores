<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Option;
class OptionDataBaseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Option::factory()->count(30)->create();
  }
}
