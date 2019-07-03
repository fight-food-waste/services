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
                'rules' => 'required|string|min:3'
            ])
            ->add('last_name', Field::TEXT, [
                'rules' => 'required|string|min:3'
            ])
            ->add('email', Field::EMAIL, [
                'rules' => 'required|email'
            ])
            ->add('password', Field::PASSWORD, [
                'rules' => 'required|string|min:8|confirmed'
            ])
            ->add('password_confirmation', Field::PASSWORD)
            ->add('submit', Field::BUTTON_SUBMIT);
    }
}
