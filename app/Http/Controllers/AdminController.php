<?php

namespace App\Http\Controllers;

use App\Volunteer;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdminController extends Controller
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

    public function checkAdmin(Request $request)
    {
        abort_if($request->user()->type != "admin", 403);
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request)
    {
        $this->checkAdmin($request);

        return view('admin', [
            'user' => $request->user(),
            'volunteers' => Volunteer::where('status', 'unapproved')->get(),
        ]);
    }

    /**
     * Approve a volunteer
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function approveVolunteer(Request $request)
    {
        $this->checkAdmin($request);

        $volunteer = Volunteer::where('id', $request->route('id'))->first();

        $volunteer->status = "active";
        $volunteer->save();

        return redirect('/admin')->with('success', 'Volunteer ' . $request->route('id') . ' has been approved.');
    }

    /**
     * Reject a Volunteer
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function rejectVolunteer(Request $request)
    {
        $this->checkAdmin($request);

        $volunteer = Volunteer::where('id', $request->route('id'))->first();

        $volunteer->status = "rejected";
        $volunteer->save();

        return redirect('/admin')->with('success', 'Volunteer ' . $request->route('id') . ' has been rejected.');
    }

    /**
     * Download a volunteer application PDF
     *
     * @param Request $request
     * @return BinaryFileResponse
     */
    public function downloadVolunteerApplication(Request $request)
    {
        $this->checkAdmin($request);

        $filename = $request->route('id') . '.pdf';
        $filepath = storage_path('app' . DIRECTORY_SEPARATOR . 'application_files' . DIRECTORY_SEPARATOR . $filename);

        return response()->file($filepath);
    }
}
