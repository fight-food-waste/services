<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(Request $request)
    {
        $members = Member::all();

        return view('admin.members.index', [
            'user' => $request->user(),
            'members' => $members,
        ]);
    }
}
