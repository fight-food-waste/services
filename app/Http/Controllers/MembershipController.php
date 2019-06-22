<?php

namespace App\Http\Controllers;

use App\Membership;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class MembershipController extends Controller
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
        $user = $request->user();

        return view('membership', ['user' => $user]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function renew(Request $request)
    {
        $user = $request->user();

        if ($user->hasValidMembership()) {
            return redirect('/membership')->with('success', 'You already have a valid membership');
        } else {
            $user->membership_end_date = date('Y-m-d', strtotime('+1 years'));
            $user->save();

            return redirect('/membership')->with('success', 'You now have a valid membership');

        }
    }
}
