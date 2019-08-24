<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ServiceRequest;

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
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $user = $request->user();

        $serviceRequests = ServiceRequest::all();

        return view('admin.services_requests.index',
            compact(
                'user',
                'serviceRequests',
            )
        );
    }

    public function cancel(ServiceRequest $serviceRequest, Request $request)
    {
        $user = $request->user();

        abort_unless($user->type === "admin", 403);

        $serviceRequest->status = -1;
        $serviceRequest->save();

        return redirect()->back()->with('success', __('flash.service_request_controller.cancel_success', ['service_request' => $request->route('id')]));
    }
}
