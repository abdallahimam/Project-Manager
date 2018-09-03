<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0; $i < 30 ; $i++) {
            DB::table('companies')->insert([
                'name' => str_random(20),
                'description' => str_random(200),
            ]);
        }
    }
}
