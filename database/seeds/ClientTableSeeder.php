<?php

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Client::create([
            'user_id'           => '7',
            'company'           => 'cloudwalk',
            'contact_person'    => 'cloud walk',
            'contact_number'    => '9624192',
            'birthdate'         => '2017-8-8',
            'email'             => 'cloudwalk@cwd.com',
            'brands'            => '[{"name": "Gatsby"}, {"name": "Creamsilk"}]'
        ]);

        Client::create([
            'user_id'           => '7',
            'company'           => 'Medix',
            'contact_person'    => 'Me dix',
            'contact_number'    => '9624192',
            'birthdate'         => '2017-7-7',
            'email'             => 'mdx@medix.com',
            'brands'            => '[{"name": "Med"}, {"name": "Dental"}]'
        ]);

    }

}
