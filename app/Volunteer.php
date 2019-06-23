<?php

namespace App;

use Tightenco\Parental\HasParent;

class Volunteer extends User
{
    use HasParent;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'service_id', 'status',
    ];

    /**
     * Get the service associated with the volunteer.
     */
    public function service()
    {
        return $this->hasOne('App\Service');
    }
}
