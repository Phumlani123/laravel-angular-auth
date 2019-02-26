<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Client;
class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            Client::create([
            'name' => $faker->name,
            ]);
        }
    }
}
