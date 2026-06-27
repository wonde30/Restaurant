<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleUserSeeder extends Seeder
{
  public function run(): void
  {
    // Optional: Clear the table first to avoid duplicates
    // User::truncate();

    $users = [
      [
        'id' => Str::uuid(), // ✅ MUST HAVE THIS
        'first_name' => 'System',
        'last_name' => 'Admin',
        'email' => 'admin@hotel.com',
        'phone' => '0911111111',
        'password_hash' => Hash::make('Admin123@'),
        'role' => 'admin',
        'is_active' => true,
      ],
      [
        'id' => Str::uuid(), // ✅ MUST HAVE THIS
        'first_name' => 'John',
        'last_name' => 'Reception',
        'email' => 'receptionist@hotel.com',
        'phone' => '0922222222',
        'password_hash' => Hash::make('Reception123@'),
        'role' => 'receptionist',
        'is_active' => true,
      ],
      [
        'id' => Str::uuid(), // ✅ MUST HAVE THIS
        'first_name' => 'Sarah',
        'last_name' => 'Cashier',
        'email' => 'cashier@hotel.com',
        'phone' => '0933333333',
        'password_hash' => Hash::make('Cashier123@'),
        'role' => 'cashier',
        'is_active' => true,
      ],
      [
        'id' => Str::uuid(), // ✅ MUST HAVE THIS
        'first_name' => 'David',
        'last_name' => 'Manager',
        'email' => 'manager@hotel.com',
        'phone' => '0944444444',
        'password_hash' => Hash::make('Manager123@'),
        'role' => 'manager',
        'is_active' => true,
      ],
      [
        'id' => Str::uuid(), // ✅ MUST HAVE THIS
        'first_name' => 'Michael',
        'last_name' => 'Chef',
        'email' => 'chef@hotel.com',
        'phone' => '0955555555',
        'password_hash' => Hash::make('Chef123@'),
        'role' => 'chef',
        'is_active' => true,
      ],
    ];

    foreach ($users as $user) {
      // Using updateOrCreate prevents duplicate email errors if you run the seeder multiple times
      User::updateOrCreate(
        ['email' => $user['email']],
        $user
      );
    }
  }
}
