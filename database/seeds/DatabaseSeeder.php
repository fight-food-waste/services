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
    }
}
