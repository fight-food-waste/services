<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class MemberForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('first_name', Field::TEXT, [
                'rules' => 'required|string|min:3',
                'label' => __('signup.first_name'),
            ])
            ->add('last_name', Field::TEXT, [
                'rules' => 'required|string|min:3',
                'label' => __('signup.last_name'),
            ])
            ->add('email', Field::EMAIL, [
                'rules' => 'required|email',
                'label' => __('signup.email'),
            ])
            ->add('password', Field::PASSWORD, [
                'rules' => 'required|string|min:8|confirmed',
                'label' => __('signup.password'),
            ])
            ->add('password_confirmation', Field::PASSWORD, [
                'label' => __('signup.password_confirmation'),
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'label' => __('signup.submit'),
            ]);
    }
}
