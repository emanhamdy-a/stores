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

      $this->call(SettingDatabaseSeeder::class);
      $this->call(RoleDataBaseSeeder::class);
      $this->call(AdminDatabaseSeeder::class);
      $this->call(UserDatabaseSeeder::class);
      $this->call(CategoryDatabaseSeeder::class);
      $this->call(BrandDatabaseSeeder::class);
      $this->call(TagDatabaseSeeder::class);
      $this->call(ProductDatabaseSeeder::class);
      $this->call(AttributeDatabaseSeeder::class);
      $this->call(OptionDatabaseSeeder::class);
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
