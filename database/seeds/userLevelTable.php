<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class userLevelTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('userLevel')->insert([
            [
                'UserType' => 'Admin',
            ],
            [
                'UserType' => 'Customer',
            ]
        ]);
    }
}
