<?php

namespace Database\Seeders;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Database\Seeder;

class CategoryDatabaseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Category::factory()->count(20)->create();
    for($i=1;$i<=20;$i++){

      if($i > 5){
        $categories = Category::factory()->create([
          'parent_id' => rand($categories->id - 5,$categories->id - 1),
        ]);
      }else{
        $categories = Category::factory()->create();
      }

      Photo::factory()->create([
        'filename' => $i .'.png'
       ,'photoable_id' => $categories->id
       ,'photoable_type' => 'App\Models\Category']);
     }
  }
}
