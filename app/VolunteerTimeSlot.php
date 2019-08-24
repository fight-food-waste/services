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
            case 0:
                return __('admin.time_slots.form.monday');
            case 1:
                return __('admin.time_slots.form.tuesday');
            case 2:
                return __('admin.time_slots.form.wednesday');
            case 3:
                return __('admin.time_slots.form.thursday');
            case 4:
                return __('admin.time_slots.form.friday');
            case 5:
                return __('admin.time_slots.form.saturday');
            case 6:
                return __('admin.time_slots.form.sunday');
            default:
                return "Unknown";
        }
    }
}
