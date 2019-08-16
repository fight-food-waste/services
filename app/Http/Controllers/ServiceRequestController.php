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
        $availableServiceRequests = [];

        if ($request->user()->type == "admin") {
            $serviceRequests = ServiceRequest::all();

            $rejectedServiceRequests = $serviceRequests->where('status', 'rejected');

            $unapprovedServiceRequests = $serviceRequests->where('status', 'unapproved');

            $pastServiceRequests = $serviceRequests->where('start_date', '<', date('Y-m-d'))
                ->where('status', 'approved');

            $incomingServiceRequests = $serviceRequests->where('start_date', '>=', date('Y-m-d'))
                ->where('status', 'approved');
        } else {
            $serviceRequests = $request->user()->serviceRequests;

            $rejectedServiceRequests = $serviceRequests->where('status', 'rejected');

            $unapprovedServiceRequests = $serviceRequests->where('status', 'unapproved');

            $pastServiceRequests = $serviceRequests
                ->where('start_date', '<', date('Y-m-d'))
                ->where('status', 'approved');

            $incomingServiceRequests = $serviceRequests
                ->where('start_date', '>', date('Y-m-d'))
                ->where('status', 'approved');

            if ($request->user()->type == "volunteer") {
                $availableServiceRequests = ServiceRequest::where('service_id', $request->user()->service_id)
                    ->where('status', 'unapproved')->get();
            }
        }

        return view('services.index', [
            'user' => $request->user(),
            'incomingServiceRequests' => $incomingServiceRequests,
            'pastServiceRequests' => $pastServiceRequests,
            'rejectedServiceRequests' => $rejectedServiceRequests,
            'unapprovedServiceRequests' => $unapprovedServiceRequests,
            'availableServiceRequests' => $availableServiceRequests,
            'services' => Service::all(),
        ]);
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
            ->where('status', 'approved')
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
            ->where('status', 'active')
            ->get();

        return $availableVolunteers;
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
        $serviceRequestAttributes['status'] = 'unapproved';

        ServiceRequest::create($serviceRequestAttributes);

        return redirect('services')->with('success', 'Service request completed successfully.');
    }

    public function reject(ServiceRequest $serviceRequest, Request $request)
    {
        if ($serviceRequest->member_id != $request->user()->id && $request->user()->type != "admin") {
            abort(403);
        }

        $serviceRequest->status = "rejected";
        $serviceRequest->save();

        return redirect('/services')->with('success', 'Service request ' . $request->route('id') . ' has been rejected.');
    }

    public function pickUp(ServiceRequest $serviceRequest, Request $request)
    {
        if ($request->user()->type != "volunteer") {
            abort(403);
        }

        $serviceRequest->status = "approved";
        $serviceRequest->volunteer_id = $request->user()->id;
        $serviceRequest->save();

        return redirect('/services')->with('success', 'Service request ' . $request->route('id') . ' has been picked up.');
    }
}
