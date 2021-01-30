<?php

namespace Database\Seeders;
use App\Models\Brand;
use App\Models\Picture;
use Faker\Provider\Image;
use Illuminate\Http\File;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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
      $brand = Brand::factory()->create();
      $image = Image::image(null,200,200,'brand');
      $imageFile = new File($image);
      Picture::factory()->create([
        'filename' =>Storage::disk('brands')->putFile(null, $imageFile)
       ,'pictureable_id' => $brand->id
       ,'pictureable_type' => 'App\Models\Brand']);
     }
  }
}
