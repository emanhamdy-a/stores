<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductDatabaseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Product::factory()->count(20)->create();
    for($i=1;$i<=18;$i++){
      $products = Product::factory()->create();
      Photo::factory()->create([
        'filename' => $i .'.png'
       ,'photoable_id' => $products->id
       ,'photoable_type' => 'App\Models\Product'
      ]);
      Photo::factory()->create([
        'filename' =>( $i * 2 ).'.png'
        ,'photoable_id' => $products->id
        ,'photoable_type' => 'App\Models\Product'
      ]);
    }
  }
}
