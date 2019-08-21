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

        return redirect()->back()->with('success', __('flash.time_slot_controller.destroy_success'));
    }

    public function store(FormBuilder $formBuilder, Request $request)
    {
        abort_if($request->user()->type !== 'volunteer', 403);

        $form = $formBuilder->create(VolunteerTimeSlotForm::class);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        // TODO check for overlapping time slots

        $attributes = $form->getFieldValues();

        $attributes['volunteer_id'] = $request->user()->id;

        VolunteerTimeSlot::create($attributes);

        return redirect()->back()->with('success', __('flash.time_slot_controller.store_success'));
    }
}
