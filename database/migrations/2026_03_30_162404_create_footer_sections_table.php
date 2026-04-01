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
    Schema::create('footer_sections', function (Blueprint $table) {
      $table->id();
      $table->string('description')->nullable();
      $table->string('items_sold')->nullable();
      $table->string('community_earnings')->nullable();
      $table->string('gateway_image')->nullable();
      $table->string('copyright')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('footer_sections');
  }
};
