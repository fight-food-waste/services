<?php

return [
    'admin' => [
        'admin_controller' => [],
        'member_controller' => [],
        'service_controller' => [
            'store_success' => "The service has been created.",
        ],
        'volunteer_controller' => [
            'approve_volunteer_success' => "Volunteer :user has been approved.",
            'reject_volunteer_success' => "Volunteer :user has been rejected.",
        ],
    ],
    'login_controller' => [
        'logout_success' => 'Logged out successfully.',
    ],
    'register_controller' => [
        'address_not_real' => 'The address you entered does not seem real.',
        'register_success' => 'Registration successful!',
    ],
    'export_controller' => [],
    'home_controller' => [],
    'localization_controller' => [
        'locale_not_exist_error' => 'This language is not supported.',
    ],
    'membership_controller' => [
        'renew_success_1' => "You already have a valid membership",
        'renew_success_2' => "You now have a valid membership",
    ],
    'profile_controller' => [],
    'service_request_controller' => [
        'store_success' => "Service request completed successfully.",
        'cancel_mail_raw' => "'Hello, the service request #service_request has been canceled by :user_first_name.",
        'cancel_success' => "Service request :service_request has been rejected.",
        'pick_up_error' => "You can't pick up this service request",
        'pick_up_mail_raw' => "Hello, your service request #:service_request has been picked up by :user_first_name.",
        'pick_up_success' => "Service request :service_request has been picked up.",
    ],
    'time_slot_controller' => [
        'destroy_success' => "The time slot has been deleted.",
        'store_success' => "The time slot has been created.",
    ],
];
