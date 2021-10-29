<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;


class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // / data faker indonesia
        $faker = Faker::create('id_ID');
        
        // membuat data dummy sebanyak 10 record
        for($x = 1; $x <= 30; $x++){

            // insert data dummy pegawai dengan faker
            DB::table('orders')->insert([
                'order_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'customer_name' => $faker->name,
            ]);

        }
    }
}
