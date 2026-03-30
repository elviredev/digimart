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
    Schema::create('counter_sections', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->string('subtitle');
      $table->string('label_one');
      $table->string('counter_one');
      $table->string('label_two');
      $table->string('counter_two');
      $table->string('label_three');
      $table->string('counter_three');
      $table->string('label_four');
      $table->string('counter_four');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('counter_sections');
  }
};
