<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Tightenco\Parental\HasParent;
use Carbon\Carbon;

/**
 * App\Member
 *
 * @property mixed membership_end_date
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read Collection|ServiceRequest[] $serviceRequests
 * @method static Builder|Member newModelQuery()
 * @method static Builder|Member newQuery()
 * @method static Builder|Member query()
 * @mixin Eloquent
 */
class Member extends User
{
    use HasParent;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'membership_end_date', 'status'
    ];

    public function hasValidMembership()
    {
        if ($this->membership_end_date != null) {
            if (strtotime($this->membership_end_date) > strtotime('now')) {
                return true;
            }
        }
        return false;
    }

    public function serviceRequests()
    {
        return $this->hasMany('App\ServiceRequest', 'member_id');
    }

    public function getMembershipEndDateAttribute($value)
    {
        return Carbon::parse($value);
    }
}
