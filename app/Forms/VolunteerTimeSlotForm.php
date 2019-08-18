<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class VolunteerTimeSlotForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('week_day', Field::SELECT, [
                'rules' => 'required|integer|min:1|max:7',
                'choices' => [
                    1 => 'Monday',
                    2 => 'Tuesday',
                    3 => 'Wednesday',
                    4 => 'Thursday',
                    5 => 'Friday',
                    6 => 'Saturday',
                    7 => 'Sunday',
                ],
            ])
            ->add('start_time', Field::TIME, [
                'rules' => 'required|date_format:H:i',
            ])
            ->add('end_time', Field::TIME, [
                'rules' => 'required|date_format:H:i|after:start_time',
            ])
            ->add('submit', Field::BUTTON_SUBMIT);
    }
}
