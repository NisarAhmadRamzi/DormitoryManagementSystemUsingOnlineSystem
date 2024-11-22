<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch roles by name
        $adminRole = Role::where('name', 'admin')->first();
        // $secondAdminRole = Role::where('name', 'second-admin')->first();
        $studentRole = Role::where('name', 'student')->first();

        // Creating users and assigning roles
        User::create([
            'name' => 'nisar',
            'email' => 'nisar@example.com',
            'password' => Hash::make('12345678'),
            'user_role' => $adminRole->id,
        ]);

        User::create([
            'name' => 'noor',
            'email' => 'noor@example.com',
            'password' => Hash::make('12345678'),
            'user_role' => $adminRole->id,
        ]);

        User::create([
            'name' => 'nader',
            'email' => 'nader@example.com',
            'password' => Hash::make('12345678'),
            'user_role' => $studentRole->id,
        ]);
    }
}
