<?php

use Illuminate\Database\Seeder;
use App\Models\UserRole;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::create([
            'slug'  => 'super-admin',
            'name'  => 'Super Admin'
        ]);

        UserRole::create([
            'slug'  => 'admin',
            'name'  => 'Admin'
        ]);

        UserRole::create([
            'slug'  => 'department-head',
            'name'  => 'Department Head'
        ]);

        UserRole::create([
            'slug'  => 'member',
            'name'  => 'Member'
        ]);
    }
}
