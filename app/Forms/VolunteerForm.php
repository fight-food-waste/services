<?php

namespace App\Forms;

use App\Service;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class VolunteerForm extends Form
{
    public function buildForm()
    {
        $services = Service::get(['id', 'name'])->pluck('name', 'id')->all();

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
            ->add('services', Field::SELECT, [
                'rules' => 'required|array|min:1',
                'choices' => $services,
                'attr' => [
                    'multiple' => 'multiple',
                ],
            ])
            ->add('application_file', Field::FILE, [
                'rules' => 'required|file|mimes:pdf'
            ])
            ->add('submit', Field::BUTTON_SUBMIT);
    }
}
