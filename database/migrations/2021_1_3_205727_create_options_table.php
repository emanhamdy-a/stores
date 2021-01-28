<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
  //   $table->bigInteger('brand_id')
  //   ->unsigned()->nullable();
  // $table->foreign('brand_id')
  //   ->references('id')->on('brands')
  //   ->onDelete('set null');
    Schema::create('options', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('product_id')->unsigned();
      $table->bigInteger('attribute_id')->unsigned();
      $table->string('price');
      $table->foreign('product_id')->references('id')->on('products')
        ->onDelete('cascade');
      $table->foreign('attribute_id')->references('id')->on('attributes')
        ->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('options');
  }
}
