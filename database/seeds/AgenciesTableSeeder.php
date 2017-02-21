<?php

use Illuminate\Database\Seeder;
use App\Models\Agency;

class AgenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agency::create([
            'slug'  => 'cloudwalk',
            'name'  => 'Cloudwalk'
        ]);

        Agency::create([
            'slug'  => 'activations',
            'name'  => 'Activations'
        ]);

        Agency::create([
            'slug'  => 'antepara',
            'name'  => 'Antepara'
        ]);
    }
}
