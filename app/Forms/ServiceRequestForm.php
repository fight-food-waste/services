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
                'empty_value' => __('admin.services_requests.form.empty_value'),
                'label' => __('admin.services_requests.form.service'),
            ])
            ->add('date', Field::DATE, [
                'rules' => 'required|date|after:today',
                'label' => __('admin.services_requests.form.date'),
            ])
            ->add('start_time', Field::TIME, [
                'rules' => 'required|date_format:H:i',
                'label' => __('admin.services_requests.form.start_time'),
            ])
            ->add('end_time', Field::TIME, [
                'rules' => 'required|date_format:H:i|after:start_time',
                'label' => __('admin.services_requests.form.end_time'),
            ])
            ->add('description', Field::TEXT, [
                'rules' => 'required|string',
                'label' => __('admin.services_requests.form.description'),
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'label' => __('admin.services_requests.form.submit'),
            ]);
    }
}
