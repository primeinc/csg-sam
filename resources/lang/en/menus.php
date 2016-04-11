<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'title' => 'Access Management',

            'permissions' => [
                'all' => 'All Permissions',
                'create' => 'Create Permission',
                'edit' => 'Edit Permission',
                'groups' => [
                    'all' => 'All Groups',
                    'create' => 'Create Group',
                    'edit' => 'Edit Group',
                    'main' => 'Groups',
                ],
                'main' => 'Permissions',
                'management' => 'Permission Management',
            ],

            'roles' => [
                'all' => 'All Roles',
                'create' => 'Create Role',
                'edit' => 'Edit Role',
                'management' => 'Role Management',
                'main' => 'Roles',
            ],

            'users' => [
                'all' => 'All Users',
                'change-password' => 'Change Password',
                'create' => 'Create User',
                'deactivated' => 'Deactivated Users',
                'deleted' => 'Deleted Users',
                'edit' => 'Edit User',
                'main' => 'Users',
            ],
        ],

        'log-viewer' => [
            'main' => 'Log Viewer',
            'dashboard' => 'Dashboard',
            'logs' => 'Logs',
        ],

        'sidebar' => [
            'dashboard' => 'Admin Dashboard',
            'general' => 'Admin Nav',
        ],
    ],

    'frontend' => [
        'access' => [
            'title' => 'Access Management',

            'permissions' => [
                'all' => 'All Permissions',
                'create' => 'Create Permission',
                'edit' => 'Edit Permission',
                'groups' => [
                    'all' => 'All Groups',
                    'create' => 'Create Group',
                    'edit' => 'Edit Group',
                    'main' => 'Groups',
                ],
                'main' => 'Permissions',
                'management' => 'Permission Management',
            ],

            'roles' => [
                'all' => 'All Roles',
                'create' => 'Create Role',
                'edit' => 'Edit Role',
                'management' => 'Role Management',
                'main' => 'Roles',
            ],

            'users' => [
                'all' => 'All Users',
                'change-password' => 'Change Password',
                'create' => 'Create User',
                'deactivated' => 'Deactivated Users',
                'deleted' => 'Deleted Users',
                'edit' => 'Edit User',
                'main' => 'Users',
            ],
        ],

        'log-viewer' => [
            'main' => 'Log Viewer',
            'dashboard' => 'Dashboard',
            'logs' => 'Logs',
        ],

        'samples' => [
            'main' => 'Samples',
            'search' => 'Samples Search',
            'recent' => 'Recent Samples',
            'out' => 'All Active Checkouts',
            'listOut' => 'List Active Checkouts',
            'add' => 'Add Sample',
            'bulk' => 'Bulk Edit',
            'outRep' => 'Active Samples Managed By ',
            'outDsr' => 'Checked Out to ',
            'outLoc' => 'Samples Located @ ',
            'outDs' => 'Checked Out to ',
            'outMfr' => 'Samples by ',
            'mine' => 'My Sample Checkouts',
        ],

        'dealers' => [
            'main' => 'Dealers',
            'dsr' => 'List Dealer Sales Reps',
            'createDsr' => 'Add Dealer Sales Rep',
            'dealerships' => 'List Dealerships',
        ],

        'mfrs' => [
            'main' => 'Manufacturers',
            'list' => 'List Manufacturers',
        ],

        'sidebar' => [
            'dashboard' => 'Dashboard',
            'general' => 'General',
            'admin'   => 'Admin Access',
        ],
    ],

    'language-picker' => [
        'language' => 'Language',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'da' => 'Danish',
            'de' => 'German',
            'en' => 'English',
            'es' => 'Spanish',
            'fr' => 'French',
            'it' => 'Italian',
            'pt-BR' => 'Brazilian Portuguese',
            'sv' => 'Swedish',
        ],
    ],
];
