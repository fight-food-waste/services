<?php

namespace App;

class ServiceRequestTimeSlot extends TimeSlot
{
    protected $table = 'time_slots';

    protected $fillable = [
        'start_time',
        'end_time',
        'date',
        'service_request_id',
    ];

    protected $dates = [
        'date',
    ];

    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class);
    }
}
