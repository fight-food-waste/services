<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class ServiceForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', Field::TEXT, [
                'rules' => 'required|string|min:3',
                'label' => __('admin.services.form.name'),
            ])
            ->add('shortname', Field::TEXT, [
                'rules' => 'required|string|min:3',
                'label' => __('admin.services.form.short_name'),
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'label' => __('admin.services.form.submit'),
            ]);
    }
}
