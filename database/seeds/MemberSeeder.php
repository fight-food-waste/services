<?php

use App\Member;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Member::create([
            'first_name' => 'Eric',
            'last_name' => 'Dupuis',
            'email' => 'member1@gmail.com',
            'password' => Hash::make('password'),
            'status' => 1,
            'membership_end_date' => '2020-06-25',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Member::create([
            'first_name' => 'Erwan',
            'last_name' => 'Lachaise',
            'email' => 'member2@gmail.com',
            'password' => Hash::make('password'),
            'status' => 1,
            'membership_end_date' => '2020-03-12',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
