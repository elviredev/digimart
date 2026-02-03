<?php

namespace Database\Seeders\Frontend;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    User::create([
      'avatar' => '/defaults/avatar.png',
      'name' => 'John Doe',
      'email' => 'john@example.com',
      'password' => bcrypt('12345678'),
    ]);

    User::create([
      'avatar' => '/defaults/avatar.png',
      'name' => 'Author',
      'email' => 'author@example.com',
      'user_type' => 'author',
      'kyc_status' => 1,
      'password' => bcrypt('12345678'),
    ]);
  }
}
