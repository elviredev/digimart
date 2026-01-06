<?php

namespace Database\Seeders\Admin;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Super Admin
    $admin = new Admin();
    $admin->avatar = '/defaults/avatar.png';
    $admin->name = 'Super Admin';
    $admin->email = 'admin@example.com';
    $admin->password = bcrypt('12345678');
    $admin->save();
    $admin->assignRole('super admin');

    // Reviewer
    $reviewer = new Admin();
    $reviewer->avatar = '/defaults/avatar.png';
    $reviewer->name = 'Reviewer';
    $reviewer->email = 'reviewer@example.com';
    $reviewer->password = bcrypt('12345678');
    $reviewer->save();
    $reviewer->assignRole('reviewer');
  }
}
