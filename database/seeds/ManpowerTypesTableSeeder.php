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
    }
}
