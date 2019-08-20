<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceRequest;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\PlanningForm;

class PlanningController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(FormBuilder $formBuilder, Request $request)
    {
        $user = $request->user();
        $form = $formBuilder->create(PlanningForm::class, [
            'method' => 'GET',
            'url' => route('planning.export'),
        ]);

        abort_if($user->type === 'member', 403);

        return view('planning.index', compact('user', 'form'));
    }

    public function export(FormBuilder $formBuilder, Request $request)
    {
        $form = $formBuilder->create(PlanningForm::class);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $attributes = $form->getFieldValues();

        $user = $request->user();

        $serviceRequests = ServiceRequest::whereHas('timeSlot', function ($query) use ($attributes) {
            $query->where('date', '>=', Carbon::parse($attributes['start_day']))
                ->where('date', '<=', Carbon::parse($attributes['end_day']));
        })->where('status', 1)
            ->get();

        if ($user->type === 'volunteer') {
            $serviceRequests = $serviceRequests->where('volunteer_id', $user->id);
        }

        if ($serviceRequests->count() === 0) {
            return redirect()->back()->with('error', 'The planning is empty...');
        }

        $pdf = PDF::loadView('planning.export', compact('serviceRequests', 'user'));

        return $pdf->download('planning.pdf');
    }
}
