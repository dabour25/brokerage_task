<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		//Test for 20000 Data
        factory('App\Customers',5000)->create();
		factory('App\Actions',15000)->create();
    }
}
