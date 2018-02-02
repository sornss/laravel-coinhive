<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('\Springbuck\LaravelCoinhive\Database\Seeds\RatesTableSeeder');
        $this->call('\Springbuck\LaravelCoinhive\Database\Seeds\WithdrawalsTableSeeder');
    }
}
