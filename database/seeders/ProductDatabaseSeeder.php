<?php

namespace Database\Seeders;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductDatabaseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   * php artisan db:seed --class=ProductDatabaseSeeder
   * @return void
   */
  public function run()
  {
    // Product::factory()->count(30)->create();
    for($i=1;$i<=100;$i++){
      $product = Product::factory()->create();
        for($n=1 ; $n<=3 ; $n++){
          Image::factory()->create([
           'product_id' => $product->id,
          ]);
        }
    }
  }
}
