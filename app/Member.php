<?php

namespace App;

use Tightenco\Parental\HasParent;

class Member extends User
{
    use HasParent;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'membership_active', 'membership_expiration',
    ];

}
