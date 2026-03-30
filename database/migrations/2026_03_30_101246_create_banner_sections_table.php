<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('banner_sections', function (Blueprint $table) {
      $table->id();
      $table->string('background_image_one')->nullable();
      $table->string('banner_title_one')->nullable();
      $table->string('banner_subtitle_one')->nullable();
      $table->string('button_text_one')->nullable();
      $table->string('button_url_one')->nullable();

      $table->string('background_image_two')->nullable();
      $table->string('banner_title_two')->nullable();
      $table->string('banner_subtitle_two')->nullable();
      $table->string('button_text_two')->nullable();
      $table->string('button_url_two')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('banner_sections');
  }
};
