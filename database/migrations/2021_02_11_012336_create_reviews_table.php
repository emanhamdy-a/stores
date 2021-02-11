<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('reviews', function (Blueprint $table) {
      $table->id();
      $table->integer('review');
      $table->bigInteger('user_id')->unsigned();
      $table->bigInteger('product_id')->unsigned();
      $table->string('title');
      $table->text('content');
      $table->foreign('user_id')
        ->references('id')->on('users')
        ->onDelete('cascade');
      $table->foreign('product_id')
        ->references('id')->on('products')
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
    Schema::dropIfExists('reviews');
  }
}
