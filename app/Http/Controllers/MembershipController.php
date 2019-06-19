<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentUserId = Auth::user()->id;
        $currentUser = User::findOrFail($currentUserId);
        return view('membership', ['user' => $currentUser]);
    }

    public function renew()
    {
        $currentUserId = Auth::user()->id;
        $currentUser = User::findOrFail($currentUserId);

        $currentUser->membership_active = true;
        $currentUser->membership_expiration = date('Y-m-d', strtotime('+1 year'));
        $currentUser->save();

        return redirect('/membership')->with('success', 'You now have a valid membership');

    }
}
