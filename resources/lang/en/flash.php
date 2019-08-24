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
    'account_controller' => [
        'update_success' => "Your account has been successfully updated!",
        'destroy_error' => "Something went wrong while deleting your account.",
        'destroy_success' => "Your account has been deleted.",
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
    'planning_controller' => [
        'export_error' => "The planning is empty...",
    ],
    'profile_controller' => [],
    'service_request_controller' => [
        'store_success' => "Service request completed successfully.",
        'cancel_mail_raw' => "Hello, the service request #:service_request has been canceled by :user_first_name.",
        'cancel_success' => "Service request :service_request has been rejected.",
        'service_request_canceled' => "A service request has been canceled",
        'pick_up_error' => "You can't pick up this service request",
        'pick_up_mail_raw' => "Hello, your service request #:service_request has been picked up by :user_first_name.",
        'service_picked_up' => "Your service request has been picked up",
        'pick_up_success' => "Service request :service_request has been picked up.",
        'unapproved_account' => "You can't access service requests because your account has not been approved by an admin.",
    ],
    'time_slot_controller' => [
        'destroy_success' => "The time slot has been deleted.",
        'store_success' => "The time slot has been created.",
        'store_error' => "The time slot is overlapping with another time slot."
    ],
];
