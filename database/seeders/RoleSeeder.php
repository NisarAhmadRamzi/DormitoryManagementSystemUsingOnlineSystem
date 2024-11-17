<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creating roles
        $roles = [
            ['name' => 'admin'], 
            ['name' => 'second-admin'], 
            ['name' => 'student']
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
