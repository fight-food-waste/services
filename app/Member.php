<?php

namespace App;

use Tightenco\Parental\HasParent;

/**
 * @property mixed membership_end_date
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
}
