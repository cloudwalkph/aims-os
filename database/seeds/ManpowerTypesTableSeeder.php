<?php

use Illuminate\Database\Seeder;
use App\Models\ManpowerType;

class ManpowerTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ManpowerType::create([
            'slug'  => 'setup',
            'name'  => 'Setup'
        ]);

        ManpowerType::create([
            'slug'  => 'ba',
            'name'  => 'BA'
        ]);

        ManpowerType::create([
            'slug'  => 'promodizer',
            'name'  => 'Promodizer'
        ]);

        ManpowerType::create([
            'slug'  => 'push-girl',
            'name'  => 'Push Girl'
        ]);

        ManpowerType::create([
            'slug'  => 'seller',
            'name'  => 'Seller'
        ]);

        ManpowerType::create([
            'slug'  => 'pa',
            'name'  => 'PA'
        ]);

        ManpowerType::create([
            'slug'  => 'repacker',
            'name'  => 'Repacker'
        ]);

        ManpowerType::create([
            'slug'  => 'team-leader',
            'name'  => 'TL'
        ]);

        ManpowerType::create([
            'slug'  => 'assistant-team-leader',
            'name'  => 'ATL'
        ]);

        ManpowerType::create([
            'slug'  => 'project-coordinator',
            'name'  => 'Project Coordinator'
        ]);
    }
}
