<?php

use Illuminate\Database\Seeder;

class WithdrawalsTableSeeder extends Seeder
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
            DB::table('withdrawals')->insert([
                'user_id' => rand(1, 100),
                'coins' => $faker->randomNumber(3)
            ]);
        }
    }
}
