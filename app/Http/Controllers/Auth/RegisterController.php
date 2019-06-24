<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMember;
use App\Http\Requests\StoreVolunteer;
use App\Member;
use App\Service;
use App\Volunteer;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @param string $userType
     * @return View
     */
    public function showRegistrationForm(string $userType)
    {
        return view('auth.register.' . $userType, ['services' => Service::all()]);
    }

    /**
     * Show the registration dispatcher (choose user type)
     *
     * @return View
     */
    public function showRegistrationDispatcher()
    {
        return view('auth.register.dispatch');
    }


    /** Create a new Volunteer instance after a valid registration.
     * And redirect to home page
     *
     * @param StoreVolunteer $request
     * @return RedirectResponse
     */
    public function storeVolunteer(StoreVolunteer $request)
    {
        $user_attributes = $request->validated();

        $user_attributes['password'] = Hash::make($user_attributes['password']);
        $user_attributes['status'] = "unapproved";

        // Upload application file
        $application_file = $user_attributes['application_file'];
        $filename = uniqid() . ".pdf";
        $application_file->storeAs('application_files', $filename);
        $user_attributes['application_filename'] = $filename;

        Volunteer::create($user_attributes);

        return redirect($this->redirectPath())->with('success', 'User created successfully.');
    }

    /**
     * Create a new Member instance after a valid registration.
     * And redirect to home page
     *
     * @param StoreMember $request
     * @return RedirectResponse
     */
    public function storeMember(StoreMember $request)
    {
        $user_attributes = $request->validated();

        $user_attributes['password'] = Hash::make($user_attributes['password']);

        $user_attributes['status'] = "active";

        Member::create($user_attributes);

        return redirect($this->redirectPath())->with('success', 'User created successfully.');
    }
}
