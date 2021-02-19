<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Option;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

      $this->call(SettingDataBaseSeeder::class);
      $this->call(RoleDataBaseSeeder::class);
      $this->call(AdminDataBaseSeeder::class);
      $this->call(UserDataBaseSeeder::class);
      $this->call(CategoryDataBaseSeeder::class);
      $this->call(BrandDataBaseSeeder::class);
      $this->call(TagDataBaseSeeder::class);
      $this->call(ProductDataBaseSeeder::class);
      $this->call(AttributeDataBaseSeeder::class);
      $this->call(OptionDataBaseSeeder::class);
      $this->call(SliderDataBaseSeeder::class);

      $products=Product::all();

      foreach ($products as $product) {
        $categories = [];
        $categories[] = Category::all()->random()->id;
        $categories[] = Category::all()->random()->id;
        $categories[] = Category::all()->random()->id;

        $product->categories()->sync( $categories );

        $tags = [];
        $tags[] = Tag::all()->random()->id;
        $tags[] = Tag::all()->random()->id;
        $tags[] = Tag::all()->random()->id;

        $product->tags()->sync( $tags );
      }

    }
}
