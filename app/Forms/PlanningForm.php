<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class PlanningForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('start_day', Field::DATE, [
                'rules' => 'required|date|after_or_equal:today',
                'label' => __('admin.planning.form.start_day'),
            ])
            ->add('end_day', Field::DATE, [
                'rules' => 'required|date|after:today|after:start_time',
                'label' => __('admin.planning.form.end_day'),
            ])
            ->add('download', Field::BUTTON_SUBMIT, [
                'label' => __('admin.planning.form.download')
            ]);
    }
}
