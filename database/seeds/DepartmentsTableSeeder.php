<?php

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'slug'  => 'productions',
            'name'  => 'Productions'
        ]);

        Department::create([
            'slug'  => 'creatives',
            'name'  => 'Creatives'
        ]);

        Department::create([
            'slug'  => 'cmtuva',
            'name'  => 'CMTUVA'
        ]);

        Department::create([
            'slug'  => 'hr',
            'name'  => 'HR'
        ]);

        Department::create([
            'slug'  => 'inventory',
            'name'  => 'Inventory'
        ]);

        Department::create([
            'slug'  => 'admin',
            'name'  => 'Admin'
        ]);

        Department::create([
            'slug'  => 'ae',
            'name'  => 'Account Executives'
        ]);

        Department::create([
            'slug'  => 'accounting',
            'name'  => 'Accounting'
        ]);

        Department::create([
            'slug'  => 'setup',
            'name'  => 'Setup'
        ]);

        Department::create([
            'slug'  => 'operations',
            'name'  => 'Operations'
        ]);

        Department::create([
            'slug'  => 'activations',
            'name'  => 'Project Manager'
        ]);

        Department::create([
            'slug'  => 'negotiators',
            'name'  => 'Negotiators'
        ]);

        Department::create([
            'slug'  => 'tl',
            'name'  => 'Team Leader'
        ]);
    }
}
