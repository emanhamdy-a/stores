<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      User::factory(10)->create();
      $this->call(SettingDatabaseSeeder::class);
      $this->call(AdminDatabaseSeeder::class);
      $this->call(CategoryDatabaseSeeder::class);
      $this->call(BrandDatabaseSeeder::class);
      $this->call(TagDatabaseSeeder::class);
      $this->call(ProductDatabaseSeeder::class);
      $this->call(AttributeDatabaseSeeder::class);
    }
}
