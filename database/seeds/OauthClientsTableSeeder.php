<?php

use Illuminate\Database\Seeder;

class OauthClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->truncate();

        DB::table('oauth_clients')->insert([
            'id'        => 1,
            'name'      => 'Laravel Personal Access Client',
            'secret'    => 'hZ1WDvkRKwTWRZ3gb7sZGuNw17EtIy7Z4OYEmox7',
            'redirect'  => 'http://localhost',
            'personal_access_client'    => 1,
            'password_client'           => 0,
            'revoked'                   => 0
        ]);

        DB::table('oauth_clients')->insert([
            'id'        => 2,
            'name'      => 'Laravel Password Grant Client',
            'secret'    => 'ImKH3L4AwfSRnxeaGKfNh5hsCgGyGzHn91Yz9ppZ',
            'redirect'  => 'http://localhost',
            'personal_access_client'    => 0,
            'password_client'           => 1,
            'revoked'                   => 0
        ]);
    }
}
