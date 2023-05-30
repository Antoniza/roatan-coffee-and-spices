<?php

namespace Database\Seeders;

use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'name' => 'Susana R. Kane',
            'email' => 'susanakane23gmail.com',
            'phone' => '+1 (619) 415-3060',
            'rank' => 1,
            'password' =>  Hash::make('admin123'),
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        DB::table('clients')->insert([
            'full_name' => 'Consumidor Final',
            'rtn' => '0000000000000000',
            'email' => '----------------------------',
            'phone' => '+(000) 0000-0000',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
    }
}
