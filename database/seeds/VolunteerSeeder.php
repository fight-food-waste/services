<?php

use App\Volunteer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VolunteerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Volunteer::create([
            'first_name' => 'Thomas',
            'last_name' => 'Martin',
            'email' => 'volunteer1@gmail.com',
            'password' => Hash::make('password'),
            'status' => 1,
            'application_filename' => '5d1015e662aaf.pdf',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ])->services()->attach([1, 2]);

        Volunteer::create([
            'first_name' => 'Arthur',
            'last_name' => 'Papaye',
            'email' => 'volunteer2@gmail.com',
            'password' => Hash::make('password'),
            'status' => 1,
            'application_filename' => 'jdkjfdhfjs.pdf',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ])->services()->attach([2, 3]);
    }
}
