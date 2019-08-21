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
                    1 => __('admin.time_slots.form.monday'),
                    2 => __('admin.time_slots.form.tuesday'),
                    3 => __('admin.time_slots.form.wednesday'),
                    4 => __('admin.time_slots.form.thursday'),
                    5 => __('admin.time_slots.form.friday'),
                    6 => __('admin.time_slots.form.start_time'),
                    7 => __('admin.time_slots.form.sunday'),
                ],
                'label' => __('admin.time_slots.form.week_day'),
            ])
            ->add('start_time', Field::TIME, [
                'rules' => 'required|date_format:H:i',
                'label' => __('admin.time_slots.form.start_time')
            ])
            ->add('end_time', Field::TIME, [
                'rules' => 'required|date_format:H:i|after:start_time',
                'label' => __('admin.time_slots.form.end_time'),
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'label' => __('admin.time_slots.form.submit')
            ]);
    }
}
