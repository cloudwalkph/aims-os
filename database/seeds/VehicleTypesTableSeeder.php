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
            'name'  => 'L300 FB Van'
        ]);

        VehicleType::create([
            'slug'  => 'commuter-van',
            'name'  => 'Commuter Van'
        ]);

        VehicleType::create([
            'slug'  => 'h100-van',
            'name'  => 'H100 Van'
        ]);

        VehicleType::create([
            'slug'  => 'closed-truck',
            'name'  => 'Closed Truck'
        ]);

        VehicleType::create([
            'slug'  => 'open-truck',
            'name'  => 'Open Truck'
        ]);
    }
}
