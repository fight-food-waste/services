<?php

use App\ServiceRequest;
use Illuminate\Database\Seeder;

class ServiceRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceRequest::create([
            'start_date' => '2019-07-01 10:00:00',
            'hour_count' => 2,
            'service_id' => 1,
            'member_id' => 2,
            'volunteer_id' => 4,
            'status' => 0,
            'description' => 'About my service request...',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        ServiceRequest::create([
            'start_date' => '2019-07-01 10:00:00',
            'hour_count' => 2,
            'service_id' => 1,
            'member_id' => 3,
            'volunteer_id' => 5,
            'status' => 0,
            'description' => 'About my service request...',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
