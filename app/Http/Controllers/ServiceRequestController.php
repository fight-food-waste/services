<?php

namespace App\Http\Controllers;

use App\Service;
use App\ServiceRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\ServiceRequestForm;
use App\ServiceRequestTimeSlot;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;


class ServiceRequestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(FormBuilder $formBuilder, Request $request)
    {
        $user = $request->user();
        $services = Service::all();

        $form = $formBuilder->create(ServiceRequestForm::class, [
            'method' => 'POST',
            'url' => route('service_requests.store'),
        ]);

        $serviceRequests = $user->serviceRequests;

        $cancelledServiceRequests = $serviceRequests->where('status', -1);

        $unassignedServiceRequests = $serviceRequests->where('status', 0);

        $pastServiceRequests = ServiceRequest::whereHas('timeSlot', function ($query) {
            $query->where('date', '<', Carbon::now()->format('Y-m-d'));
        })->where('status', 1)
            ->get();

        $incomingServiceRequests = ServiceRequest::whereHas('timeSlot', function ($query) {
            $query->where('date', '>=', Carbon::now()->format('Y-m-d'));
        })->where('status', 1)
            ->get();

        if ($user->type == "volunteer") {
            // Get unassigned service requests corresponding to one the volunteer's service
            $unassignedServiceRequests = ServiceRequest::whereIn('service_id', $user->services->pluck('id'))
                ->whereStatus(0)->get();

            $incomingServiceRequests = $incomingServiceRequests->where('volunteer_id', $user->id);
            $pastServiceRequests = $pastServiceRequests->where('volunteer_id', $user->id);
        }

        if ($user->type == "member") {
            $incomingServiceRequests = $incomingServiceRequests->where('member_id', $user->id);
            $pastServiceRequests = $pastServiceRequests->where('member_id', $user->id);
        }

        return view('services.index',
            compact(
                'user',
                'incomingServiceRequests',
                'pastServiceRequests',
                'cancelledServiceRequests',
                'unassignedServiceRequests',
                'services',
                'form'
            )
        );
    }

    /**
     * Check for conflicting ServiceRequest and get all available volunteers for the second form
     *
     * @param FormBuilder $formBuilder
     * @param Request     $request
     * @return Factory|View
     */
    public function store(FormBuilder $formBuilder, Request $request)
    {
        abort_if(! $request->user()->hasValidMembership(), 403);

        $form = $formBuilder->create(ServiceRequestForm::class);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $attributes = $form->getFieldValues();

        $attributes['member_id'] = $request->user()->id;

        $serviceRequest = ServiceRequest::create($attributes);

        $attributes['service_request_id'] = $serviceRequest->id;

        ServiceRequestTimeSlot::create($attributes);

        return redirect(route('service_requests.index'))->with('success', __('flash.admin.service_controller.store_success'));
    }

    public function cancel(ServiceRequest $serviceRequest, Request $request)
    {
        if ($serviceRequest->member_id != $request->user()->id && $request->user()->type != "admin") {
            abort(403);
        }

        $serviceRequest->status = -1;
        $serviceRequest->save();

        return redirect(route('service_requests.index'))->with('success', __('flash.service_request_controller.cancel_success', ['user' => $request->route('id')]));
    }

    public function pickUp(ServiceRequest $serviceRequest, Request $request)
    {
        if ($request->user()->type != "volunteer") {
            abort(403);
        }

        if (! $request->user()->canPickUp($serviceRequest)) {
            return redirect()->back()->with('error', __('flash.service_request_controller.pick_up_error'));
        }

        $serviceRequest->status = 1;
        $serviceRequest->volunteer_id = $request->user()->id;
        $serviceRequest->save();

        Mail::raw(__('flash.service_request_controller.mail_raw', [
            'service_request' => $serviceRequest->id,
            'user_first_name' => $request->user()->getFullName()
        ]), function ($message) use ($serviceRequest) {
                $message->from('noreply@fight-food-waste.com', 'Fight Food Waste')
                    ->to($serviceRequest->member->email)
                    ->subject('You service request has been picked up');
            });

        return redirect(route('service_requests.index'))->with('success', __('flash.service_request_controller.pick_up_success', ['service_request' => $request->route('id')]));
    }
}
