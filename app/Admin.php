<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Tightenco\Parental\HasParent;

/**
 * App\Admin
 *
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @method static Builder|Admin newModelQuery()
 * @method static Builder|Admin newQuery()
 * @method static Builder|Admin query()
 * @mixin Eloquent
 */
class Admin extends User
{
    use HasParent;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'status',
    ];
}
