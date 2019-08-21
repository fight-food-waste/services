<?php

return [
    'admin' => [
        'admin_controller' => [],
        'bundle_controller' => [
            'approve_success' => 'Le lot :bundle a été approuvé.',
            'reject_success' => 'Le lot :bundle a été rejeté.',
            'reject_product_error' => "Le produit n'a pas pu être supprimé.",
            'reject_product_success' => 'Le produit a bien été supprimé du lot.',
        ],
        'category_controller' => [
            'category_updated_success' => 'La catégorie a été mise à jour.',
        ],
        'collection_round_controller' => [
            'store_success' => 'Une nouvelle collecte a été créée.',
            'update_truck_error' => 'Aucun camion disponible pour le moment.',
            'update_status_error' => "Aucun espace disponible dans l'entrepôt !",
            'update_success' => "La collecte a bien été mise à jour.",
            'remove_bundle_success' => "Le lot a bien été retiré de la collecte.",
            'remove_bundle_error' => "Cette collecte ne peut plus être modifiée.",
            'destroy_error' => "Une erreur s'est produite lors de la suppression de la collecte.",
            'destroy_success' => "La collecte a bien été supprimée.",
            'modify_error' => "Cette collecte ne peut plus être modifiée.",
            'add_bundle_success' => "Le lot a bien été ajouté à la collecte.",
            'auto_add_bundles_success' => ":count lot(s) ont été ajoutés à la collecte.",
            'auto_add_bundles_error' => "Aucun lot n'a été trouvé...",
        ],
        'delivery_request_controller' => [
            'approve_success' => "La demande de distribution :delivery_request a bien été approuvée.",
            'reject_success' => "La demande de distribution :delivery_request a bien été rejetée.",
            'reject_product_success' => "Le produit a bien été supprimé de la demande de distribution.",
        ],
        'delivery_round_controller' => [
            'store_success' => "Une nouvelle distribution a été crée.",
            'update_error' => "Il n'y a aucun camion de disponible pour le moment.",
            'update_success' => "La distribution a bien été mise à jour.",
            'remove_delivery_request_success' => "La demande de distribution a bien été supprimée de la distribution.",
            'remove_delivery_request_error' => "La distribution ne peut plus être modifiée.",
            'destroy_error' => "Une erreur s'est produite lors de la suppression de la distribution.",
            'destroy_error_2' => "La distribution ne peut plus être modifiée.",
            'destroy_success' => "La distribution a bien été supprimée.",
            'add_delivery_request_success' => "La demande de distribution a bien été ajoutée à la distribution.",
            'auto_add_delivery_requests_success' => " demande(s) de distribution ajoutée(s) à la distribution avec succès.",
            'auto_add_delivery_requests_error' => "Aucune demande de distribution trouvée...",
        ],
        'products_controller' => [
            'reject_success' => 'Le produit a été invalidé.',
        ],
        'truck_controller' => [
            'store_success' => "Le camion a bien été enregistré.",
            'update_success' => "Le camion a été modifié avec succès !",
            'destroy_error' => "Une erreur s'est produite durant la modification du camion.",
            'destroy_success' => "Le camion a bien a été supprimé !",
        ],
        'user_controller' => [
            'approve_success' => "L'utilisateur :user a bien approuvé.",
            'reject_success' => "L'utilisateur :user a bien rejeté.",
        ],
        'warehouse_controller' => [
            'store_success' => "L'entrepôt a bien été enregistré.",
            'update_error' => "Le nombre d'étagères ne peut être qu'augmenté.",
            'update_success' => "L'entrepôt a été modifié avec succès !",
            'destroy_error' => "Une erreur s'est produite durant la suppression de l'entrepôt.",
            'destroy_success' => "L'entreprôt a bien été supprimé !",
        ],
    ],
    'account_controller' => [
        'update_success' => "Votre compte a bien été mis à jour !",
        'destroy_error' => "Une erreur s'est produite lors de la suppression de votre compte.",
        'destroy_success' => "Votre compte a été supprimé avec succès.",
    ],
    'login_controller' => [
        'logout_success' => "Déconnexion faite avec succès.",
    ],
    'register_controller' => [
        'address_not_real' => "L'adresse entrée ne semble être réelle.",
        'register_success' => "Inscription réussie !",
    ],
    'bundle_controller' => [
        'access_forbidden' => "Accès refusé : vous n'êtes autorisé à voir ce lot.",
        'destroy_error' => "Une erreur s'est produite lors de la suppression de ce lot.",
        'destroy_success' => "Le lot a bien été supprimé.",
    ],
    'delivery_request_controller' => [
        'access_forbidden' => "Accès refusé : vous n'êtes autorisé à voir cette demande de distribution.",
        'store_success' => "La demande de distribution a bien été créée !",
        'store_error' => "La demande de distribution a déjà été ouverte.",
        'destroy_success' => "La demande de distribution a bien été annulée.",
        'destroy_error' => "La demande de distribution ne peut pas être annulée.",
    ],
    'product_controller' => [
        'destroy_success' => "Le produit a bien été supprimé.",
        'destroy_error' => "Le produit n'a pas pu être supprimé.",
        'add_to_delivery_request_success' => "Le produit a bien été ajouté à la demande de distribution.",
        'remove_from_delivery_request_success' => "Le produit a bien été été supprimé de la demande de distribution.",
    ],
    'localization_controller' => [
        'locale_not_exist_error' => 'Cette langue n\'est pas supportée.',
    ],
];
