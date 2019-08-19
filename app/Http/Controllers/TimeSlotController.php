<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VolunteerTimeSlot;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\VolunteerTimeSlotForm;

class TimeSlotController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(FormBuilder $formBuilder, Request $request)
    {
        abort_if($request->user()->type !== 'volunteer', 403);

        $form = $formBuilder->create(VolunteerTimeSlotForm::class, [
            'method' => 'POST',
            'url' => route('time_slots.store'),
        ]);

        return view('time_slots.index', [
            'user' => $request->user(),
            'form' => $form,
        ]);
    }

    public function destroy(VolunteerTimeSlot $timeSlot, Request $request)
    {
        abort_if($request->user()->type !== 'volunteer', 403);

        $timeSlot->delete();

        return redirect()->back()->with('success', 'The time slot has been deleted.');
    }

    public function store(FormBuilder $formBuilder, Request $request)
    {
        abort_if($request->user()->type !== 'volunteer', 403);

        $form = $formBuilder->create(VolunteerTimeSlotForm::class);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $attributes = $form->getFieldValues();
        $attributes['volunteer_id'] = $request->user()->id;

        $newTimeSlot = new VolunteerTimeSlot($attributes);

        foreach ($request->user()->timeSlots as $timeSlot) {
            if ($timeSlot->week_day == $newTimeSlot->week_day) {
                if (! (($timeSlot->start_time->isBefore($newTimeSlot->start_time) && $timeSlot->end_time->isBefore($newTimeSlot->start_time))
                    || ($timeSlot->start_time->isAfter($newTimeSlot->end_time) && $timeSlot->end_time->isAfter($newTimeSlot->end_time)))) {
                    return redirect()->back()->with('error', 'The time slot is overlapping with another time slot.');
                }
            }
        }

        $newTimeSlot->save();

        return redirect()->back()->with('success', 'The time slot has been created.');
    }
}
