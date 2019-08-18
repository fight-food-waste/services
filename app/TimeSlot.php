<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class TimeSlot extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'start_time',
        'end_time',
    ];

    public function getStartTimeAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function getEndTimeAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function period(): CarbonPeriod
    {
        return CarbonPeriod::create($this->start_time, $this->end_time);
    }
}
