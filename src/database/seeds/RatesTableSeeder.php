<?php

use Illuminate\Database\Seeder;

class RatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
        for ($i=0; $i < 100; $i++) {
            DB::table('rates')->insert([
                'rate' => $faker->randomNumber(3)
            ]);
        }
    }
}
