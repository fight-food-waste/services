<?php

namespace App\Exports;

use App\ServiceRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

/**
 * @property int volunteer_id
 */
class PlanningExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(int $volunteer_id)
    {
        $this->volunteer_id = $volunteer_id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ServiceRequest::where('volunteer_id', $this->volunteer_id)
            ->where('start_date', '>=', date('Y-m-d'))
            ->get();
    }

    public function map($service_request): array
    {
        return [
            $service_request->getStartDay(),
            $service_request->getEndDay(),
            $service_request->hour_count,
            $service_request->service()->value('name'),
            $service_request->member()->value('first_name') . ' ' . $service_request->member()->value('last_name'),
        ];
    }

    public function headings(): array
    {
        return [
            'Start Date',
            'End Date',
            'Hours',
            'Service',
            'Member'
        ];
    }
}
