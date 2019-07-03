<?php

namespace App\Http\Controllers;

use App\Forms\MemberForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class MemberController extends Controller
{
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(MemberForm::class, [
            'method' => 'POST',
            'url' => route('member.store')
        ]);

        return view('member.create', compact('form'));
    }

    public function store(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(MemberForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        dd($form);
        // Do saving and other things...
    }
}
