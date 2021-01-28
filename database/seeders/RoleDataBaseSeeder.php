<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleDataBaseSeeder extends Seeder
{
  // php artisan make:seeder AdminDataBaseSeeder
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Role::create([
        'name'  =>  'supervisor',
        'permissions' =>'["products","tags","categories","brands","options","admins","settings","profile","sliders","attributes","roles"]'
      ]);
    Role::create([
      'name'  =>  'admin',
      'permissions' =>'["products","tags","categories","brands","options","profile","sliders","attributes"]',
    ]);
    Role::create([
      'name'  =>  'dataentry',
      'permissions' =>'["products"]',
    ]);
  }
}
