<?php

namespace Database\Seeders;

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
      $this->call(UserDatabaseSeeder::class);
      $this->call(AdminDatabaseSeeder::class);
      $this->call(CategoryDatabaseSeeder::class);
      $this->call(BrandDatabaseSeeder::class);
      $this->call(TagDatabaseSeeder::class);
      $this->call(ProductDatabaseSeeder::class);
      $this->call(AttributeDatabaseSeeder::class);
    }
}
