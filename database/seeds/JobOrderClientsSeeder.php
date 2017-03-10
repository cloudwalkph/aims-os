<?php

use Illuminate\Database\Seeder;
use App\Models\JobOrderClient;

class JobOrderClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobOrderClient::create([
            'job_order_id'  => '1',
            'client_id'     => '1',
            'brands'        => '[{"name": "Gatsby"}, {"name": "Creamsilk"}]'
        ]);
        JobOrderClient::create([
            'job_order_id'  => '2',
            'client_id'     => '2',
            'brands'        => '[{"name": "Med"}, {"name": "Dental"}]'
        ]);
    }
}
