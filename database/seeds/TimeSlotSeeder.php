<?php

use Illuminate\Database\Seeder;
use App\ServiceRequestTimeSlot;
use Carbon\Carbon;
use App\VolunteerTimeSlot;

class TimeSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceRequestTimeSlot::create([
            'start_time' => '10:00:00',
            'end_time' => '14:00:00',
            'date' => Carbon::now()->add(1, 'day'),
            'service_request_id' => 1,
        ]);

        ServiceRequestTimeSlot::create([
            'start_time' => '11:00:00',
            'end_time' => '17:00:00',
            'date' => Carbon::now()->add(3, 'day'),
            'service_request_id' => 2,
        ]);

        VolunteerTimeSlot::create([
            'start_time' => '10:00:00',
            'end_time' => '14:00:00',
            'week_day' => 1,
            'volunteer_id' => 4,
        ]);

        VolunteerTimeSlot::create([
            'start_time' => '08:00:00',
            'end_time' => '20:00:00',
            'week_day' => 6,
            'volunteer_id' => 5,
        ]);
    }
}
