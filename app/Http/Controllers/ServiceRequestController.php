<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrepareServiceRequest;
use App\Service;
use App\ServiceRequest;
use App\Volunteer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

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

    public function index(Request $request)
    {
        $unassignedServiceRequests = [];
        $user = $request->user();
        $services = Service::all();

        if ($user->type == "admin") {
            $serviceRequests = ServiceRequest::all();

            $cancelledServiceRequests = $serviceRequests->where('status', -1);

            $unassignedServiceRequests = $serviceRequests->where('status', 0);

            $pastServiceRequests = $serviceRequests->where('start_date', '<', date('Y-m-d'))
                ->where('status', 1);

            $incomingServiceRequests = $serviceRequests->where('start_date', '>=', date('Y-m-d'))
                ->where('status', 1);
        } else {
            $serviceRequests = $user->serviceRequests;

            $cancelledServiceRequests = $serviceRequests->where('status', -1);

            $unassignedServiceRequests = $serviceRequests->where('status', 0);

            $pastServiceRequests = $serviceRequests
                ->where('start_date', '<', date('Y-m-d'))
                ->where('status', 1);

            $incomingServiceRequests = $serviceRequests
                ->where('start_date', '>', date('Y-m-d'))
                ->where('status', 1);

            if ($user->type == "volunteer") {
                $unassignedServiceRequests = ServiceRequest::where('service_id', $user->service_id)
                    ->where('status', 0)->get();
            }
        }

        return view('services.index',
            compact(
                'user',
                'incomingServiceRequests',
                'pastServiceRequests',
                'cancelledServiceRequests',
                'unassignedServiceRequests',
                'services'
            )
        );
    }

    /**
     * Check for conflicting ServiceRequest and get all available volunteers for the second form
     *
     * @param PrepareServiceRequest $request
     * @return Factory|View
     */
    public function store(PrepareServiceRequest $request)
    {
        abort_if(! $request->user()->hasValidMembership(), 403);

        $serviceRequestAttributes = $request->validated();

        $serviceRequestAttributes['member_id'] = $request->user()->id;

        ServiceRequest::create($serviceRequestAttributes);

        return redirect(route('service_requests.index'))->with('success', 'Service request completed successfully.');
    }

    public function cancel(ServiceRequest $serviceRequest, Request $request)
    {
        if ($serviceRequest->member_id != $request->user()->id && $request->user()->type != "admin") {
            abort(403);
        }

        $serviceRequest->status = -1;
        $serviceRequest->save();

        return redirect(route('service_requests.index'))->with('success', 'Service request ' . $request->route('id') . ' has been rejected.');
    }

    public function pickUp(ServiceRequest $serviceRequest, Request $request)
    {
        if ($request->user()->type != "volunteer") {
            abort(403);
        }

        $serviceRequest->status = 1;
        $serviceRequest->volunteer_id = $request->user()->id;
        $serviceRequest->save();

        return redirect(route('service_requests.index'))->with('success', 'Service request ' . $request->route('id') . ' has been picked up.');
    }

    /**
     * Get available volunteers for a potential service request
     *
     * @param ServiceRequest $serviceRequest
     * @return mixed
     */
    private function getAvailableVolunteers(ServiceRequest $serviceRequest)
    {
        // Get all ServiceRequest for the same Service that can potentially be conflicting for the time range
        $serviceRequestsForSameService = ServiceRequest::where('service_id', $serviceRequest->service_id)
            ->where('status', 1)
            ->get();

        $conflictingServiceRequests = [];

        // Extract all conflicting ServiceRequest
        foreach ($serviceRequestsForSameService as $tmpServiceRequest) {

            // Check if the new ServiceRequest's time range does not overlap with another service request
            if (($tmpServiceRequest->getStartDate() < $serviceRequest->getStartDate() && $tmpServiceRequest->getEndDate() < $serviceRequest->getStartDate())
                || ($tmpServiceRequest->getStartDate() > $serviceRequest->getEndDate() && $tmpServiceRequest->getEndDate() > $serviceRequest->getEndDate())) {
                // no conflict
            } else {
                array_push($conflictingServiceRequests, $tmpServiceRequest->volunteer_id);
            }
        }

        // Get all volunteers which don't have a ServiceRequest conflicting with the new one
        $availableVolunteers = Volunteer::where('service_id', $serviceRequest->service_id)
            ->whereNotIn('id', $conflictingServiceRequests)
            ->where('status', 1)
            ->get();

        return $availableVolunteers;
    }
}
