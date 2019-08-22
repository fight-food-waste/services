<?php

return [
    'admin' => [
        'admin_controller' => [],
        'member_controller' => [],
        'service_controller' => [
            'store_success' => "Le service a bien été créé.",
        ],
        'volunteer_controller' => [
            'approve_volunteer_success' => "Le bénévole :user a été approuvé.",
            'reject_volunteer_success' => "Le bénévole :user a été rejeté.",
        ],
    ],
    'login_controller' => [
        'logout_success' => "Déconnexion faite avec succès.",
    ],
    'register_controller' => [
        'address_not_real' => "L'adresse entrée ne semble être réelle.",
        'register_success' => "Inscription réussie !",
    ],
    'export_controller' => [],
    'home_controller' => [],
    'localization_controller' => [
        'locale_not_exist_error' => "Cette langue n'est pas supportée.",
    ],
    'membership_controller' => [
        'renew_success_1' => "Vous disposez déjà d'une adhésion valide",
        'renew_success_2' => "Vous êtes désormais adhérent !",
    ],
    'profile_controller' => [],
    'service_request_controller' => [
        'store_success' => "La demande de service a été effectuée avec succès.",
        'cancel_success' => "La demande de service :user a été rejetée.",
        'pick_up_error' => "Vous ne pouvez vous attribuer cette demande de service",
        'mail_raw' => "Bonjour, votre demande de service #:service_request a été attribuée à :user_first_name.",
        'pick_up_success' => "La demande de service :service_request a été attribuée.",
    ],
    'time_slot_controller' => [
        'destroy_success' => "Le créneau a été supprimé.",
        'store_success' => "Le créneau a été créé.",
    ],
];
