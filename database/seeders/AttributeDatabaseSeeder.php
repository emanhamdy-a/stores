<?php

namespace Database\Seeders;
use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeDatabaseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Attribute::factory()->count(5)->create();
  }
}
