<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('it_IT');

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
        ]);

        $types = ['clear', 'isolated-clouds', 'scattered-clouds', 'overcast', 'light-rain',
        'moderate-rain','heavy-rain', 'sleet','light-snow','moderate-snow','heavy-snow','fog','na',
         'clear', 'isolated-clouds', 'scattered-clouds', 'overcast', 'light-rain','moderate-rain','heavy-rain',
          'sleet','light-snow','moderate-snow','heavy-snow','fog','na'];
            foreach(range(1, 26) as $i) {
                DB::table('recommendations')->insert([
                'name' => $faker->word,
                'sku' => $faker->numberBetween($min = 1000, $max = 9000),
                'price' => $faker->numberBetween($min = 10, $max = 50),
                'type' => $types[$i-1],

            ]);
        }
    }
}


