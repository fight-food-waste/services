<?php

namespace App;

use Tightenco\Parental\HasParent;

class Admin extends User
{
    use HasParent;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'status',
    ];
}
