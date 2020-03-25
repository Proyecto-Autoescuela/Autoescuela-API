<?php

use Illuminate\Database\Seeder;
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
            'name' => 'ADMIN',
            'email' => 'superadmin@cev.com',
            'password' => Hash::make('admin123'),
            'api_token' => 'c2356069e9d1e79ca924378153cfbbfb4d4416b1f99d41a2940bfdb66c5319db',
        ]);

        DB::table('users')->insert([
            'name' => 'ADMIN2',
            'email' => 'superadmin2@cev.com',
            'password' => Hash::make('admin123'),
            'api_token' => 'c2356069e9d1e79ca924378153cfbbfb4d4416b1f99d41a2940bfdb66c5319dl',
        ]);

        DB::table('teachers')->insert([
            'name' => 'Teacher',
            'email' => 'teacher@cev.com',
            'password' => Hash::make('teacher123'),
        ]);

        DB::table('teachers')->insert([
            'name' => 'Daniel Palacio',
            'email' => 'dani@cev.com',
            'password' => Hash::make('dani123'),
        ]);
        
        DB::table('students')->insert([
            'name' => 'Mario Frigi',
            'email' => 'mariofrigi@cev.com',
            'password' => Hash::make('mario123'),
            'teacher_id' => '1',
            'license' => 'B',
        ]);

        DB::table('students')->insert([
            'name' => 'Mario Perez',
            'email' => 'marioperez@cev.com',
            'password' => Hash::make('mario123'),
            'teacher_id' => '1',
            'license' => 'A2',
        ]);

        DB::table('students')->insert([
            'name' => 'Raul Gonzalez',
            'email' => 'raulgon@cev.com',
            'password' => Hash::make('raul123'),
            'teacher_id' => '1',
            'license' => 'A',
        ]);
    }
}
