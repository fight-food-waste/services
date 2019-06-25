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
        return view('services.index', [
            'user' => $request->user(),
            'service_requests' => $request->user()->serviceRequests()->get(),
            'services' => Service::all(),
        ]);
    }

    /**
     * Get available volunteers for a potential service request
     *
     * @param ServiceRequest $serviceRequest
     * @return mixed
     */
    private function getAvailableVolunteers(ServiceRequest $serviceRequest) {
        // Get all ServiceRequest for the same Service that can potentially be conflicting for the time range
        $serviceRequestsForSameService = ServiceRequest::where('service_id', $serviceRequest->service_id)->get();

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
        $availableVolunteers = Volunteer::where('service_id', $serviceRequest->service_id)->whereNotIn('id', $conflictingServiceRequests)->get();

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
        $serviceRequestAttributes = $request->validated();

        $serviceRequestAttributes['member_id'] = $request->user()->id;

        ServiceRequest::create($serviceRequestAttributes);

    return redirect('services')->with('success', 'Service request completed successfully.');
    }

}
