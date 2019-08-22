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
            ])
            ->add('end_day', Field::DATE, [
                'rules' => 'required|date|after:today|after:start_time',
            ])
            ->add('download', Field::BUTTON_SUBMIT);
    }
}
