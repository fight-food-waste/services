<?php

namespace App\Http\Controllers\Auth;

use App\Forms\MemberForm;
use App\Forms\VolunteerForm;
use App\Http\Controllers\Controller;
use App\Member;
use App\Volunteer;
use Auth;
use Hash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;

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
     * Show the registration dispatcher (choose user type)
     *
     * @return View
     */
    public function chooseUserType()
    {
        return view('register.dispatch');
    }

    /**
     * Show Member registration form
     *
     * @param FormBuilder $formBuilder
     * @return Factory|View
     */
    public function createMember(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(MemberForm::class, [
            'method' => 'POST',
            'url' => route('register.member.store')
        ]);

        return view('register.form', compact('form'));
    }

    /**
     * Store Member if valid
     *
     * @param FormBuilder $formBuilder
     * @return RedirectResponse
     */
    public function storeMember(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(MemberForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $user_attributes = $form->getFieldValues();

        $user_attributes['password'] = Hash::make($user_attributes['password']);
        $user_attributes['status'] = "active";

        $member = Member::create($user_attributes);

        Auth::login($member);

        return redirect($this->redirectPath())->with('success', 'Registration successful!');
    }

    /**
     * Show Volunteer registration form
     *
     * @param FormBuilder $formBuilder
     * @return Factory|View
     */
    public function createVolunteer(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(VolunteerForm::class, [
            'method' => 'POST',
            'url' => route('register.volunteer.store')
        ]);

        return view('register.form', compact('form'));
    }


    /**
     * Store Volunteer if valid
     *
     * @param FormBuilder $formBuilder
     * @return RedirectResponse
     */
    public function storeVolunteer(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(VolunteerForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $user_attributes = $form->getFieldValues();

        $user_attributes['password'] = Hash::make($user_attributes['password']);
        $user_attributes['status'] = "unapproved";

        // Upload application file
        $application_file = $user_attributes['application_file'];
        $filename = uniqid() . ".pdf";
        $application_file->storeAs('application_files', $filename);
        $user_attributes['application_filename'] = $filename;

        $volunteer = Volunteer::create($user_attributes);

        Auth::login($volunteer);

        return redirect($this->redirectPath())->with('success', 'Registration successful!');
    }
}