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
 * @property-read Service                                               $service
 * @property-read Collection|ServiceRequest[]                           $serviceRequests
 * @method static Builder|Volunteer newModelQuery()
 * @method static Builder|Volunteer newQuery()
 * @method static Builder|Volunteer query()
 * @mixin Eloquent
 */
class Volunteer extends User
{
    use HasParent;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'status', 'application_filename',
    ];

    public function serviceRequests()
    {
        return $this->hasMany('App\ServiceRequest', 'volunteer_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function timeSlots()
    {
        return $this->hasMany(VolunteerTimeSlot::class, 'volunteer_id');
    }

    public function canPickUp(ServiceRequest $serviceRequest)
    {
        $isVolunteerAvailable = false;
        $isOverlapping = false;

        foreach ($this->timeSlots as $volunteerTimeSlot) {
            if ($serviceRequest->timeSlot->date->weekday() == $volunteerTimeSlot->week_day) {
                if ($volunteerTimeSlot->period()->contains($serviceRequest->timeSlot->start_time)
                    && $volunteerTimeSlot->period()->contains($serviceRequest->timeSlot->end_time)) {
                    $isVolunteerAvailable = true;
                    break;
                }
            }
        }

        if (! $isVolunteerAvailable) {
            return $isVolunteerAvailable;
        } else {
            foreach ($this->serviceRequests as $volunteerServiceRequest) {
                if ($serviceRequest->timeSlot->date == $volunteerServiceRequest->timeSlot->date) {
                    if (! (($serviceRequest->timeSlot->start_time->isBefore($volunteerServiceRequest->timeSlot->start_time)
                            && $serviceRequest->timeSlot->end_time->isBefore($volunteerServiceRequest->timeSlot->start_time))
                        || ($serviceRequest->timeSlot->start_time->isAfter($volunteerServiceRequest->timeSlot->end_time)
                            && $serviceRequest->timeSlot->end_time->isAfter($volunteerServiceRequest->timeSlot->end_time)))) {
                        $isOverlapping = true;
                        break;
                    }
                }
            }

            return $isOverlapping === false;
        }
    }
}
