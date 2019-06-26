<?php

namespace App;

use Tightenco\Parental\HasParent;

class Volunteer extends User
{
    use HasParent;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'service_id', 'status', 'application_filename'
    ];

    /**
     * Get the service associated with the volunteer.
     */
    public function service()
    {
        return $this->hasOne('App\Service');
    }

    public function serviceRequests()
    {
        return $this->hasMany('App\ServiceRequest', 'volunteer_id');
    }
}
