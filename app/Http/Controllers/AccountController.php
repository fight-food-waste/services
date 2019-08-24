<?php

namespace App\Http\Controllers;

use App\Forms\AdminForm;
use App\Forms\MemberForm;
use App\Forms\VolunteerForm;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the User's account page containing his information
     *
     * @param Request $request
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        return view('account.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Show User account edit page
     *
     * @param Request $request
     * @param FormBuilder $formBuilder
     *
     * @return Factory|View
     */
    public function edit(Request $request, FormBuilder $formBuilder)
    {
        $user = $request->user();

        $form = $formBuilder->create($this->getUserFormClass($user->type), [
            'method' => 'PUT',
            'url' => route('account.update'),
        ], [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'services' => $user->type === 'volunteer' ? $user->services->pluck('id') : null,
        ]);

        return view('account.edit', compact('user', 'form'));
    }

    /**
     * Update User information with data submitted
     *
     * @param Request $request
     * @param FormBuilder $formBuilder
     *
     * @return RedirectResponse
     */
    public function update(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create($this->getUserFormClass($request->user()->type));

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $user = $request->user();
        $attributes = $form->getFieldValues();

        $user->first_name = $attributes['first_name'];
        $user->last_name = $attributes['last_name'];
        $user->email = $attributes['email'];

        // Upload application file
        $applicationFile = $attributes['application_file'];
        $fileName = uniqid() . ".pdf";
        $applicationFile->storeAs('application_files', $fileName);
        $attributes['application_filename'] = $fileName;

        if ($user->type === 'volunteer') {
            $user->services()->delete();
            $user->services()->attach($attributes['services']);

            $user->status = 0;
        }

        $attributes['password'] = Hash::make($attributes['password']);

        $user->save();

        return redirect()->back()->with('success', __('flash.account_controller.update_success'));
    }

    /**
     * Delete User
     *
     * @return Response
     * @throws Exception
     */
    public function destroy()
    {
        $user = Auth::user();

        try {
            $user->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', __('flash.account_controller.destroy_error'));
        }

        auth()->logout();

        return redirect('login')->with('success', __('flash.account_controller.destroy_success'));
    }

    /**
     * Get User Form class according to his or her type
     *
     * @param String $userType
     *
     * @return string|null
     */
    private function getUserFormClass(String $userType)
    {
        switch ($userType) {
            case 'member':
                return MemberForm::class;
            case 'volunteer';
                return VolunteerForm::class;
            case 'admin':
                return AdminForm::class;
        }

        return null;
    }
}
