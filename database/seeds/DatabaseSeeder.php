<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => bcrypt('secret'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        DB::table('categories')->insert([
            'name' => 'Games',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('subcategories')->insert([
            'name' => 'Action',
            'category_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('subcategories')->insert([
            'name' => 'MMO',
            'category_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
