<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;
use App\Service;

class ServiceRequestForm extends Form
{
    public function buildForm()
    {
        $services = Service::get(['id', 'name'])->pluck('name', 'id')->all();

        $this
            ->add('service_id', Field::SELECT, [
                'rules' => 'required|integer|exists:services,id',
                'choices' => $services,
                'empty_value' => 'Choose a service',
            ])
            ->add('date', Field::DATE, [
                'rules' => 'required|date|after:today',
            ])
            ->add('start_time', Field::TIME, [
                'rules' => 'required|date_format:H:i',
            ])
            ->add('end_time', Field::TIME, [
                'rules' => 'required|date_format:H:i|after:start_time',
            ])
            ->add('description', Field::TEXT, [
                'rules' => 'required|string',
            ])
            ->add('submit', Field::BUTTON_SUBMIT);
    }
}
