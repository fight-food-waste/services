<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Volunteer;

class VolunteerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(Request $request)
    {
        $volunteers = Volunteer::all();

        return view('admin.volunteers.index', [
            'user' => $request->user(),
            'unapprovedVolunteers' => $volunteers->where('status', 0),
            'activeVolunteers' => $volunteers->where('status', 1),
            'rejectedVolunteers' => $volunteers->where('status', -1),
        ]);
    }

    public function downloadApplication(Request $request)
    {
        $filename = $request->route('id');
        $filepath = storage_path('app' . DIRECTORY_SEPARATOR . 'application_files' . DIRECTORY_SEPARATOR . $filename);

        return response()->file($filepath);
    }

    public function approveVolunteer(Volunteer $volunteer, Request $request)
    {
        $volunteer->status = 1;
        $volunteer->save();

        return redirect()->back()->with('success', 'Volunteer ' . $request->route('id') . ' has been approved.');
    }

    public function rejectVolunteer(Volunteer $volunteer, Request $request)
    {
        $volunteer->status = -1;
        $volunteer->save();

        return redirect()->back()->with('success', 'Volunteer ' . $request->route('id') . ' has been rejected.');
    }
}
