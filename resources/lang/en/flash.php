<?php

return [
    'admin' => [
        'admin_controller' => [],
        'bundle_controller' => [
            'approve_success' => 'Bundle :bundle has been approved.',
            'reject_success' => 'Bundle :bundle has been rejected.',
            'reject_product_error' => "The product couldn't be deleted.",
            'reject_product_success' => 'The product has been deleted from the bundle.',
        ],
        'category_controller' => [
            'category_updated_success' => 'The category has been updated.',
        ],
        'collection_round_controller' => [
            'store_success' => 'A new collection round has been created',
            'update_truck_error' => 'There is no available truck at the moment.',
            'update_status_error' => 'There is not enough free space available in the warehouse!',
            'update_success' => 'The collection round status has been updated.',
            'remove_bundle_success' => 'The bundle has been removed from this collection round.',
            'remove_bundle_error' => "The collection round can't be modified anymore.",
            'destroy_error' => 'Something went wrong while deleting the collection round.',
            'destroy_success' => 'The collection round has been deleted.',
            'modify_error' => "The collection round can't be modified anymore.",
            'add_bundle_success' => 'The bundle has been added to the collection round.',
            'auto_add_bundles_success' => ':count bundles have been added to the collection round.',
            'auto_add_bundles_error' => 'No available bundle was found...',
        ],
        'delivery_request_controller' => [
            'approve_success' => "Delivery request :delivery_request has been approved.",
            'reject_success' => "Delivery request :delivery_request has been rejected.",
            'reject_product_success' => "The product has been deleted from the delivery request.",
        ],
        'delivery_round_controller' => [
            'store_success' => "A new delivery round has been created",
            'update_error' => "There is no available truck at the moment.",
            'update_success' => "The delivery round status has been updated.",
            'remove_delivery_request_success' => "The delivery request has been removed from this delivery round.",
            'remove_delivery_request_error' => "The delivery round can't be modified anymore.",
            'destroy_error' => "Something went wrong while deleting the delivery round.",
            'destroy_error_2' => "The delivery round can't be modified anymore.",
            'destroy_success' => "The delivery round has been deleted.",
            'add_delivery_request_success' => "The delivery request has been added to the delivery round.",
            'auto_add_delivery_requests_success' => " delivery requests have been added to the delivery round.",
            'auto_add_delivery_requests_error' => "No available delivery request was found...",
        ],
        'products_controller' => [
            'reject_success' => 'The product has been successfully invalidated.',
        ],
        'truck_controller' => [
            'store_success' => "The truck has been created.",
            'update_success' => "The truck has been successfully updated!",
            'destroy_error' => "Something went wrong while deleting your truck.",
            'destroy_success' => "The truck has been successfully deleted!",
        ],
        'user_controller' => [
            'approve_success' => 'User :user has been approved.',
            'reject_success' => 'User :user has been rejected.',
        ],
        'warehouse_controller' => [
            'store_success' => "The warehouse has been created.",
            'update_error' => "Number of shelves can only be increased.",
            'update_success' => "The warehouse has been successfully updated!",
            'destroy_error' => "Something went wrong while deleting the warehouse.",
            'destroy_success' => "The warehouse has been successfully deleted!",
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
    'bundle_controller' => [
        'access_forbidden' => 'Access forbidden: you are not allowed to see this bundle.',
        'destroy_error' => 'Something went wrong while deleting the bundle.',
        'destroy_success' => 'The bundle has been successfully deleted.',
    ],
    'delivery_request_controller' => [
        'access_forbidden' => 'Access forbidden: you are not allowed to see this delivery request.',
        'store_success' => 'The delivery request has been created.',
        'store_error' => 'There is already an open delivery request.',
        'destroy_success' => 'The delivery request has been successfully deleted.',
        'destroy_error' => 'The delivery request can\'t be deleted.',
    ],
    'product_controller' => [
        'destroy_success' => 'The product has been successfully deleted.',
        'destroy_error' => 'The product could not be deleted.',
        'add_to_delivery_request_success' => 'The product has been added to the delivery request.',
        'remove_from_delivery_request_success' => 'The product has been removed from the delivery request.',
    ],
    'localization_controller' => [
        'locale_not_exist_error' => 'This language is not supported.',
    ],
];
