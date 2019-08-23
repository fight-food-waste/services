<?php

return [

    'index' => [
        'services_requests' => "Demande(s) de service",
        'volunteers' => "Bénévoles",
        'members' => "Membres",
        'services' => "Services",
    ],
    'singular' => [
        'member' => 'Membre',
        'volunteer' => 'Bénévole',
        'membership' => 'Adhésion',
        'service' => "Service",
    ],
    'services' => [
        'add_new_service' => "Ajouter un nouveau service",
        'column' => [
            'name' => "Nom",
            'short_name' => "Nom court",
        ],
        'no_service' => "Aucun service.",
        'form' => [
            'name' => "Nom",
            'short_name' => "Nom court",
            'submit' => "Soumettre le formulaire",
        ],
    ],
    'services_requests' => [
        'make_new_service_request' => "Faire une nouvelle demande de service",
        'no_valid_membership' => "Demande de service impossible car vous n'avez pas d'adhésion valide !",
        'unassigned_service_requests' => "Demandes de service non-assignées",
        'columns' => [
            'day' => "Jour",
            'start_time' => "Heure de début",
            'end_time' => "Heure de fin",
            'service' => "Service",
            'volunteer' => "Bénévole",
            'member' => 'Membre',
            'pick_up' => "S'attribuer",
            'cancel' => "Annuler",
            'status' => "Status",
        ],
        'no_unassigned_requests' => "Aucune demande non-assignée",
        'available_service_requests' => "Demande(s) de service disponible",
        'no_available_request' => "Aucune demande disponible",
        'incoming_service_requests' => "Future(s) demande(s) de service",
        'no_incoming_request' => "Aucune demande future",
        'past_service_requests' => "Demande(s) de service passée(s)",
        'no_past_request' => "Aucune demande passée",
        'rejected_service_request' => "Demande(s) de service rejetée(s)",
        'no_rejected_request' => "Aucune demande rejetée",
    ],
    'time_slots' => [
        'add_new_availability_time_slot' => "Ajouter un nouveau créneau horaire de disponibilité",
        'your_availability_time_slots' => "Vos disponibilités",
        'columns' => [
            'day' => "Jour",
            'start_time' => "Heure de début",
            'end_time' => "Heure de fin",
            'delete' => 'Supprimer',
        ],
        'no_time_slot' => "Vous n'avez pour le moment aucune disponibilité.",
        'form' => [
            'week_day' => "Jour de la semaine",
            'monday' => "Lundi",
            'tuesday' => "Mardi",
            'wednesday' => "Mercredi",
            'thursday' => "Jeudi",
            'friday' => "Vendredi",
            'saturday' => "Samedi",
            'sunday' => "Dimanche",
            'start_time' => "Heure de début",
            'end_time' => "Heure de fin",
            'submit' => 'Soumettre de le formulaire',
        ],
    ],
    'membership' => [
        'membership_management' => "Gestion de l'adhésion",
        'membership_not_active' => "Votre adhésion n'est pas active. Vous ne pouvez pas demander de service.",
        'subscribe' => "S'abonner",
        'membership_active_until' => "Parfait, votre adhésion est active jusqu'au :date",
    ],
    'auth' => [
        'verify' => [
            'verify_your_email_address' => "Vérifier votre adresse email",
            'success_message' => "Un lien de validation vous a été envoyé par mail",
            'check_email_message' => "Avant de continuer, rendez-vous dans le mail contenant le lien de confirmation.",
            'did_not_receive_the_email' => "Si vous n'avez reçu de mail",
            'click_here' => "cliquez ici pour en recevoir un autre",
        ],
        'email' => [
            'reset_password' => "Réinitialiser le mot de passe",
            'email_address' => "Adresse email",
            'send_password_reset_link' => "Envoyer un lien de réinitialisation de mot de passe",
        ],
        'reset' => [
            'email_address' => "Adresse email",
            'password' => "Mot de passe",
            'password_confirmation' => "Mot de passe de confirmation",
            'reset_password' => "Réinitialiser le mot de passe",
        ]
    ],
    'volunteers' => [
        'welcome_message' => "Bienvenue, :user. Cliquez sur un des liens en dessous pour gérer les ressources.",
        'approved_volunteers' => "Bénévoles approuvés",
        'rejected_volunteers' => "Bénévoles refusés",
        'columns' => [
            'first_name' => "Prénom",
            'last_name' => "Nom de famille",
            'proof_of_application' => "Preuve de candidature",
            'approve' => "Approuver",
            'reject' => "Refuser",
            'status' => "Status",
        ],
        'no_volunteer_waiting' => "Aucun bénévole en attente d'approbation !",
        'no_approved_volunteer' => "Aucun bénévole approuvé.",
        'no_banned_volunteer' => "Aucun bénévole banni.",
    ],
    'members' => [
        'columns' => [
            'first_name' => "Prénom",
            'last_name' => "Nom de famille",
            'status' => "Status",
        ],
        'no_banned_volunteer' => "Aucun bénévole banni.",
    ],
    'planning' => [
        'your_planning_message' => "Bonjour, voici votre planning pour les 7 prochains jours.",
        'form' => [
            'start_day' => "Jour de début",
            'end_day' => "Jour de fin",
            'download' => "Télécharger",
        ]
    ],
];
