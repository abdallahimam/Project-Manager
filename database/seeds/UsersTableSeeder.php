<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 30 ; $i++) {
            $f = str_random(10);
            $m = str_random(10);
            $l = str_random(10);
            DB::table('users')->insert([
                'first_name' => $f,
                'middle_name' => $m,
                'last_name' => $l,
                'name' => $f . ' ' . $m . ' ' . $l,
                'email' => str_random(10).'@gmail.com',
                'password' => bcrypt('secret'),
                'role_id' => 3,
                'work_at' => NULL
            ]);
        }
    }
}
