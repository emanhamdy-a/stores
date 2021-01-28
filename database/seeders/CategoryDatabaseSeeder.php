<?php

namespace Database\Seeders;
use App\Models\Photo;
use App\Models\Category;
use Faker\Provider\Image;
use Illuminate\Http\File;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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
        $category = Category::factory()->create([
          'parent_id' => rand($category->id - 5,$category->id - 1),
        ]);
      }else{
        $category = Category::factory()->create();
      }

      $image = Image::image(null,400,450,'category');
      $imageFile = new File($image);

      Photo::factory()->create([
        'filename' =>Storage::disk('categories')->putFile(null, $imageFile)
       ,'photoable_id' => $category->id
       ,'photoable_type' => 'App\Models\Category']);
     }
  }
}
