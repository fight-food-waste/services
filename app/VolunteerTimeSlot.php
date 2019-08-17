<?php

namespace App;

class VolunteerTimeSlot extends TimeSlot
{
    protected $fillable = [
        'start_time',
        'end_time',
        'week_day',
        'user_id',
    ];

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class);
    }
}
