<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	[
	            'full_name' => 'Restap Customer',
	            'user_name' => 'restomer',
	            'password' => Hash::make('restomer'),
	            'role' => 2,
	            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
	        ],
	        
        	[
	            'full_name' => 'Restap Administrator',
	            'user_name' => 'restator',
	            'password' => Hash::make('restator'),
	            'role' => 5,
	            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
	        ],
        ]);
    }
}
