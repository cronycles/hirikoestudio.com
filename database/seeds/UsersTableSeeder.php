<?php

namespace Database\Seeders;

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
        DB::table('users')->delete();

        DB::table('users')->insert(array(
                array(
                    'name' => 'cronycles',
                    'email' => 'cronycles@gmail.com',
                    'password' => bcrypt('Sampdoria85')
                )
            )
        );
    }
}
