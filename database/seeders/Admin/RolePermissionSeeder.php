<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $this->createDefaultPermissions();

    $admin = new Role();
    $admin->name = 'super admin';
    $admin->guard_name = 'admin';
    $admin->save();

    $reviewer = new Role();
    $reviewer->name = 'reviewer';
    $reviewer->guard_name = 'admin';
    $reviewer->save();
    $reviewer->givePermissionTo('review products');
  }

  public function createDefaultPermissions(): void
  {
    Permission::insert([
      array('id' => '1','name' => 'review products','guard_name' => 'admin','group_name' => 'Review Products','created_at' => NULL,'updated_at' => NULL),
      array('id' => '2','name' => 'manage categories','guard_name' => 'admin','group_name' => 'Category Module','created_at' => NULL,'updated_at' => NULL),
      array('id' => '3','name' => 'manage orders','guard_name' => 'admin','group_name' => 'Manage Orders','created_at' => '2026-04-12 06:21:01','updated_at' => '2026-04-12 06:21:01'),
      array('id' => '4','name' => 'manage kyc','guard_name' => 'admin','group_name' => 'Manage KYC','created_at' => '2026-04-12 06:24:34','updated_at' => '2026-04-12 06:24:34'),
      array('id' => '5','name' => 'manage withdraw request','guard_name' => 'admin','group_name' => 'Manage Withdraw Request','created_at' => '2026-04-12 06:26:53','updated_at' => '2026-04-12 06:26:53'),
      array('id' => '6','name' => 'manage withdraw method','guard_name' => 'admin','group_name' => 'Manage Withdraw Method','created_at' => '2026-04-12 06:27:06','updated_at' => '2026-04-12 06:27:06'),
      array('id' => '7','name' => 'manage sections','guard_name' => 'admin','group_name' => 'Manage Sections','created_at' => '2026-04-12 06:38:08','updated_at' => '2026-04-12 06:38:08'),
      array('id' => '8','name' => 'manage socials','guard_name' => 'admin','group_name' => 'Manage Socials','created_at' => '2026-04-12 06:38:20','updated_at' => '2026-04-12 06:38:20'),
      array('id' => '9','name' => 'manage banner','guard_name' => 'admin','group_name' => 'Manage Banner','created_at' => '2026-04-12 06:38:35','updated_at' => '2026-04-12 06:38:35'),
      array('id' => '10','name' => 'manage custom pages','guard_name' => 'admin','group_name' => 'Manage Custom Pages','created_at' => '2026-04-12 06:38:46','updated_at' => '2026-04-12 06:38:46'),
      array('id' => '11','name' => 'manage newsletter','guard_name' => 'admin','group_name' => 'Manage Newsletter','created_at' => '2026-04-12 06:38:54','updated_at' => '2026-04-12 06:38:54'),
      array('id' => '12','name' => 'access management','guard_name' => 'admin','group_name' => 'Access Management','created_at' => '2026-04-12 06:39:05','updated_at' => '2026-04-12 06:39:05'),
      array('id' => '13','name' => 'payment setting','guard_name' => 'admin','group_name' => 'Payment Setting','created_at' => '2026-04-12 06:39:20','updated_at' => '2026-04-12 06:39:20'),
      array('id' => '14','name' => 'manage settings','guard_name' => 'admin','group_name' => 'Manage Settings','created_at' => '2026-04-12 06:39:30','updated_at' => '2026-04-12 06:39:30')
    ]);
  }
}
