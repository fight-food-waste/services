<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\ServiceForm;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(Request $request, FormBuilder $formBuilder)
    {
        $services = Service::all();

        $form = $formBuilder->create(ServiceForm::class, [
            'method' => 'POST',
            'url' => route('admin.services.store'),
        ]);

        return view('admin.services.index', [
            'user' => $request->user(),
            'services' => $services,
            'form' => $form,
        ]);
    }

    public function store(FormBuilder $formBuilder, Request $request)
    {
        $form = $formBuilder->create(ServiceForm::class);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        Service::create($form->getFieldValues());

        return redirect()->back()->with('success', __('flash.admin.service_controller.store_success'));
    }
}
