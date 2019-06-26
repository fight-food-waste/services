<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string start_date
 * @property string end_date
 * @property string status
 * @property int hour_count
 * @property int service_id
 * @property int member_id
 * @property int volunteer_id
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
        if (!isset($this->endDate)) {
            $this->calculateEndDate();
        }
        return $this->endDate;
    }

    public function getStartDate()
    {
        return date("Y-m-d H:i:s", strtotime($this->start_date));
    }
}
