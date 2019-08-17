<?php

namespace App;

class ServiceRequestTimeSlot extends TimeSlot
{
    protected $fillable = [
        'start_time',
        'end_time',
        'date',
        'service_request_id',
    ];

    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class);
    }
}
