<?php

namespace App\Http\Controllers;

use App\Exports\PlanningExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function planning(Request $request) {
        $volunteerId = $request->user()->id;

        return Excel::download(new PlanningExport($volunteerId), 'planning.xlsx');
    }
}
