<?php

namespace App\Http\Controllers;

use App\Exports\PlanningExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function planning(Request $request) {
        $volunteer_id = $request->user()->id;
        return Excel::download(new PlanningExport($volunteer_id), 'planning.xlsx');
    }
}
