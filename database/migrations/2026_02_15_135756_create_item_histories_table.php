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
    Schema::create('item_histories', function (Blueprint $table) {
      $table->id();
      $table->foreignId('author_id')->constrained('users');
      $table->foreignId('reviewer_id')->nullable();
      $table->foreignId('item_id')->constrained('items');
      $table->enum('status', ['approved', 'soft_rejected', 'hard_rejected', 'pending', 'resubmitted'])->nullable();
      $table->string('title')->nullable();
      $table->text('body')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('item_histories');
  }
};
