<?php

namespace App;

class VolunteerTimeSlot extends TimeSlot
{
    protected $table = 'time_slots';

    protected $fillable = [
        'start_time',
        'end_time',
        'week_day',
        'volunteer_id',
    ];

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class);
    }

    public function getWeekDayName(): string
    {
        switch ($this->week_day) {
            case 1:
                return "Monday";
            case 2:
                return "Tuesday";
            case 3:
                return "Wednesday";
            case 4:
                return "Thursday";
            case 5:
                return "Friday";
            case 6:
                return "Saturday";
            case 7:
                return "Sunday";
            default:
                return "Unknown";
        }
    }
}
