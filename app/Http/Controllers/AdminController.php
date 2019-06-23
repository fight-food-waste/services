<?php

namespace App\Http\Controllers;

use App\Volunteer;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

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

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->type != "admin") {
            abort(403);
        }

        return view('admin', [
            'user' => $request->user(),
            'volunteers' => Volunteer::where('status', 'unapproved')->get(),
        ]);
    }

    public function approveVolunteer(int $id)
    {
        $volunteer = Volunteer::where('id', $id)->first();

        $volunteer->status = "active";
        $volunteer->save();

        return redirect('/admin')->with('success', "Volunteer $id has been approved.");
    }

    public function rejectVolunteer(int $id)
    {
        $volunteer = Volunteer::where('id', $id)->first();

        $volunteer->status = "rejected";
        $volunteer->save();

        return redirect('/admin')->with('success', "Volunteer $id has been rejected.");
    }
}
