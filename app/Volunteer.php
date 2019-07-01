<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Tightenco\Parental\HasParent;

/**
 * App\Volunteer
 *
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read Service $service
 * @property-read Collection|ServiceRequest[] $serviceRequests
 * @method static Builder|Volunteer newModelQuery()
 * @method static Builder|Volunteer newQuery()
 * @method static Builder|Volunteer query()
 * @mixin Eloquent
 */
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
