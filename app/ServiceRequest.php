<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\ServiceRequest
 *
 * @property string start_date
 * @property string end_date
 * @property string status
 * @property int hour_count
 * @property int service_id
 * @property int member_id
 * @property int volunteer_id
 * @property-read Member $member
 * @property-read Service $service
 * @property-read Volunteer $volunteer
 * @method static Builder|ServiceRequest newModelQuery()
 * @method static Builder|ServiceRequest newQuery()
 * @method static Builder|ServiceRequest query()
 * @mixin Eloquent
 */
class ServiceRequest extends Model
{
    protected $fillable = [
        'start_date', 'status', 'hour_count', 'service_id', 'member_id', 'volunteer_id'
    ];

    public function member()
    {
        return $this->belongsTo('App\Member');
    }

    public function volunteer()
    {
        return $this->belongsTo('App\Volunteer');
    }

    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    private function calculateEndDate()
    {
        $startDateStr = strtotime($this->start_date);
        $endDateStr = strtotime(sprintf("+%d hours", $this->hour_count), $startDateStr);
        $this->end_date = date("Y-m-d H:i:s", $endDateStr);
    }

    public function getEndDate()
    {
        if (!isset($this->end_date)) {
            $this->calculateEndDate();
        }
        return $this->end_date;
    }

    public function getStartDate()
    {
        return date("Y-m-d H:i:s", strtotime($this->start_date));
    }

    public function getStartDay()
    {
        return date("Y-m-d", strtotime($this->start_date));
    }

    public function getEndDay()
    {
        if (!isset($this->end_date)) {
            $this->calculateEndDate();
        }
        return date("Y-m-d", strtotime($this->end_date));
    }
}
