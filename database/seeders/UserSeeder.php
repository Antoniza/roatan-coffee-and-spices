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
            'name' => 'Administrador',
            'email' => 'example@gmail.com',
            'phone' => '5555-5555',
            'rank' => 1,
            'password' =>  Hash::make('admin123'),
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
    }
}
