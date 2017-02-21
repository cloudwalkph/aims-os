<?php

use Illuminate\Database\Seeder;
use App\Models\VehicleType;

class VehicleTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VehicleType::create([
            'slug'  => 'l300',
            'name'  => 'L300'
        ]);

        VehicleType::create([
            'slug'  => 'small-truck',
            'name'  => 'Small Truck'
        ]);

        VehicleType::create([
            'slug'  => 'big-truck',
            'name'  => 'Big Truck'
        ]);
    }
}
