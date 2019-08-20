<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceRequest;
use Barryvdh\DomPDF\Facade as PDF;

class PlanningController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = $request->user();

        abort_if($user->type === 'member', 403);

        if ($user->type === 'volunteer') {
            $serviceRequests = $user->serviceRequests;
        } elseif ($user->type === 'admin') {
            $serviceRequests = ServiceRequest::all();
        }

        return view('planning.index', compact('serviceRequests', 'user'));
    }

    public function export(Request $request)
    {
        $user = $request->user();

        $serviceRequests = $request->user()->serviceRequests;
        $pdf = PDF::loadView('planning.export', compact('serviceRequests', 'user'));

        return $pdf->download('planning.pdf');
    }
}
