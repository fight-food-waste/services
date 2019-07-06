<?php

namespace App\Http\Controllers;

use App\Member;
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
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request)
    {
        $volunteers = Volunteer::all();
        $members = Member::where('status', 'active')->get();

        return view('admin', [
            'user' => $request->user(),
            'members' => $members,
            'unapprovedVolunteers' => $volunteers->where('status', 'unapproved'),
            'activeVolunteers' => $volunteers->where('status', 'active'),
            'rejectedVolunteers' => $volunteers->where('status', 'rejected'),
            'bannedVolunteers' => $volunteers->where('status', 'banned')
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
        $filename = $request->route('id') . '.pdf';
        $filepath = storage_path('app' . DIRECTORY_SEPARATOR . 'application_files' . DIRECTORY_SEPARATOR . $filename);

        return response()->file($filepath);
    }
}
