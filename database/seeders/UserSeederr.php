<?php

namespace Database\Seeders;

use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeederr extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(Generator::class);

        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'example@gmail.com',
            'email_verified_at' => now(),
            'rank' => 1,
            'password' =>  Hash::make('password'),
            'created_at'=> $faker->dateTimeBetween($startDate = '-1 day', $endDate = 'now'),
            'updated_at'=> $faker->dateTimeBetween($startDate = '-1 day', $endDate = 'now'),
        ]);
    }
}
