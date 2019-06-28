<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'name' => 'Plumbing',
            'shortname' => 'plumbing',
        ]);
        Service::create([
            'name' => 'Cooking classes',
            'shortname' => 'cooking-classes',
        ]);
        Service::create([
            'name' => 'Car sharing',
            'shortname' => 'car-sharing',
        ]);
        Service::create([
            'name' => 'Repair services',
            'shortname' => 'repair-services',
        ]);
        Service::create([
            'name' => 'Guarding',
            'shortname' => 'guarding',
        ]);
        Service::create([
            'name' => 'Housing/DIY',
            'shortname' => 'housing-dyi',
        ]);
        Service::create([
            'name' => 'Electricity',
            'shortname' => 'electricity',
        ]);
    }
}
