<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            'name' => 'Plumbing',
            'shortname' => 'plumbing',
        ]);
        DB::table('services')->insert([
            'name' => 'Cooking classes',
            'shortname' => 'cooking-classes',
        ]);
        DB::table('services')->insert([
            'name' => 'Car sharing',
            'shortname' => 'car-sharing',
        ]);
        DB::table('services')->insert([
            'name' => 'Repair services',
            'shortname' => 'repair-services',
        ]);
        DB::table('services')->insert([
            'name' => 'Guarding',
            'shortname' => 'guarding',
        ]);
        DB::table('services')->insert([
            'name' => 'Housing/DIY',
            'shortname' => 'housing-dyi',
        ]);
        DB::table('services')->insert([
            'name' => 'Electricity',
            'shortname' => 'electricity',
        ]);
        DB::table('users')->insert([
            'first_name' => 'Jean',
            'last_name' => 'Dupont',
            'email' => 'jean@dupont.fr',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'type' => 'admin',
            'status' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
