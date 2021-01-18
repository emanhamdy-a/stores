<?php

namespace Database\Seeders;
use App\Models\Brand;
use App\Models\Photo;
use Illuminate\Database\Seeder;

class BrandDatabaseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Brand::factory()->count(20)->create();
    for($i=1;$i<=10;$i++){
      $brands = Brand::factory()->create();
      Photo::factory()->create([
        'filename' => $i .'.png'
       ,'photoable_id' => $brands->id
       ,'photoable_type' => 'App\Models\Brand']);
     }
  }
}
