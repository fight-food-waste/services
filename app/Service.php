<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Service
 *
 * @method static Builder|Service newModelQuery()
 * @method static Builder|Service newQuery()
 * @method static Builder|Service query()
 * @mixin Eloquent
 */
class Service extends Model
{
    protected $fillable = [
        'name', 'shortname'
    ];

    public function volunteers()
    {
        return $this->belongsToMany(Volunteer::class);
    }

    public function getNameAttribute($value)
    {
        $service = Service::where('name', $value)->first();

        return __('main.service.' . $service->shortname);
    }
}
