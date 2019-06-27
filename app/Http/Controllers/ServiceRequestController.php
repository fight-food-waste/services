<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrepareServiceRequest;
use App\Http\Requests\StoreServiceRequest;
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
        if ($request->user()->type == "admin") {
            $service_requests = ServiceRequest::all();
        } else {
            $service_requests = $request->user()->serviceRequests()->get();
        }
        return view('services.index', [
            'user' => $request->user(),
            'service_requests' => $service_requests,
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

        $conflictingServiceRequests = array();

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
    public function prepareNew(PrepareServiceRequest $request)
    {
        abort_if(! $request->user()->hasValidMembership(), 403);

        $serviceRequestAttributes = $request->validated();

        // Create new object to access getEndDate(), it will be saved after the next form
        $serviceRequest = new ServiceRequest($serviceRequestAttributes);

        // Get Service info related to the ServiceRequest
        $requestedService = Service::where('id', $serviceRequest->service_id)->first();

        $availableVolunteers = $this->getAvailableVolunteers($serviceRequest);

        return view('services.new', [
            'user' => $request->user(),
            'service_request' => $serviceRequest,
            'requested_service' => $requestedService,
            'available_volunteers' => $availableVolunteers,
        ]);
    }

    public function confirmNew(StoreServiceRequest $request)
    {
        abort_if(! $request->user()->hasValidMembership(), 403);

        $serviceRequestAttributes = $request->validated();

        $serviceRequestAttributes['member_id'] = $request->user()->id;
        $serviceRequestAttributes['status'] = 'unapproved';

        ServiceRequest::create($serviceRequestAttributes);

        return redirect('services')->with('success', 'Service request completed successfully.');
    }

    public function approve(Request $request)
    {
        $serviceRequest = ServiceRequest::where('id', $request->route('id'))->first();

        if ($serviceRequest->volunteer_id != $request->user()->id) {
            abort(403);
        }

        $serviceRequest->status = "approved";
        $serviceRequest->save();

        return redirect('/services')->with('success', 'Service request ' . $request->route('id') . ' has been approved.');
    }

    public function reject(Request $request)
    {
        $serviceRequest = ServiceRequest::where('id', $request->route('id'))->first();

        if ($serviceRequest->volunteer_id != $request->user()->id) {
            abort(403);
        }

        $serviceRequest->status = "rejected";
        $serviceRequest->save();

        return redirect('/services')->with('success', 'Service request ' . $request->route('id') . ' has been rejected.');
    }

}
