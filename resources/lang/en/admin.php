<?php

return [

    'index' => [
        'services_request(s)' => "Service request(s)",
        'volunteers' => "Volunteers",
        'members' => "Members",
        'services' => "Services",
    ],
    'singular' => [
        'member' => 'Member',
        'volunteer' => 'Volunteer',
        'membership' => 'Membership',
        'service' => "Service",
    ],
    'services' => [
        'add_new_service' => "Add a new service",
        'column' => [
            'name' => "Name",
            'short_name' => "Short name",
        ],
        'no_service' => "There is no service.",
        'form' => [
            'name' => "Nom",
            'short_name' => "Short name",
            'submit' => "Submit",
        ],
    ],
    'services_requests' => [
        'make_new_service_request' => "Make a new service request",
        'no_valid_membership' => "You don't have a valid membership, so you can't request a service!",
        'unassigned_service_requests' => "Unassigned Service Requests",
        'columns' => [
            'day' => "Day",
            'start_time' => "Start time",
            'end_time' => "End time",
            'service' => "Service",
            'volunteer' => "Volunteer",
            'member' => 'Member',
            'pick_up' => "Pick up",
            'cancel' => "Cancel",
            'status' => "Status",
        ],
        'no_unassigned_requests' => "There are no unassigned request",
        'available_service_requests' => "Available Service Requests",
        'no_available_request' => "There are no available request",
        'incoming_service_requests' => "Incoming Service Requests",
        'no_incoming_request' => "There are no incoming request",
        'past_service_requests' => "Past Service Requests",
        'no_past_request' => "There are no past request",
        'rejected_service_request' => "Rejected Service Requests",
        'no_rejected_request' => "There are no rejected request",
    ],
    'time_slots' => [
        'add_new_availability_time_slot' => "Add a new availability time slot",
        'your_availability_time_slots' => "Your availability time slots",
        'columns' => [
            'day' => "Day",
            'start_time' => "Start time",
            'end_time' => "End time",
            'delete' => 'Delete',
        ],
        'no_time_slot' => "You don't have any time slot yet.",
        'form' => [
            'week_day' => "Week day",
            'monday' => "Monday",
            'tuesday' => "Tuesday",
            'wednesday' => "Wednesday",
            'thursday' => "Thursday",
            'friday' => "Friday",
            'saturday' => "Saturday",
            'sunday' => "Sunday",
            'start_time' => "Start time",
            'end_time' => "End time",
            'submit' => 'Submit',
        ],
    ],
    'membership' => [
        'membership_management' => "Membership management",
        'membership_not_active' => "Your membership is not active. You can't request services.",
        'subscribe' => "S'abonner",
        'membership_active_until' => "Great, your membership is active until the :date",
    ],
    'auth' => [
        'verify' => [
            'verify_your_email_address' => "Verify Your Email Address",
            'success_message' => "A fresh verification link has been sent to your email address.",
            'check_email_message' => "Before proceeding, please check your email for a verification link.",
            'did_not_receive_the_email' => "If you did not receive the email",
            'click_here' => "click here to request another",
        ],
        'email' => [
            'reset_password' => "Reset Password",
            'email_address' => "E-Mail Address",
            'send_password_reset_link' => "Send Password Reset Link",
        ],
        'reset' => [
            'email_address' => "E-Mail Address",
            'password' => "Password",
            'password_confirmation' => "Password confirmation",
            'reset_password' => "Reset Password",
        ]
    ],
    'volunteers' => [
        'welcome_message' => "Welcome, :user. Click one of the links below to manage resources.",
        'approved_volunteers' => "Approved volunteers",
        'rejected_volunteers' => "Rejected volunteers",
        'waiting_for_approval' => "Volunteers waiting for approval",
        'columns' => [
            'first_name' => "First Name",
            'last_name' => "Last Name",
            'proof_of_application' => "Proof of application",
            'approve' => "Approve",
            'reject' => "Reject",
            'status' => "Status",
        ],
        'no_volunteer_waiting' => "There is no volunteer waiting for approval!",
        'no_approved_volunteer' => "There is no approved volunteer.",
        'no_banned_volunteer' => "There is no banned volunteer.",
    ],
    'members' => [
        'columns' => [
            'first_name' => "First Name",
            'last_name' => "Last Name",
            'status' => "Status",
        ],
        'no_banned_volunteer' => "There is no banned volunteer.",
    ],
    'planning' => [
        'your_planning_message' => "Hello, here is your planning for the next 7 days.",
        'form' => [
            'start_day' => "Start day",
            'end_day' => "End day",
            'download' => "Download",
        ]
    ],
];
