<?php
return [
    'app_name' => env('APP_NAME', "Junket Monitoring System"),

    'user_type' => [
        'UT_001' => env('Admin', 'Admin'),
        'UT_002' => env('Supervisor', 'Supervisor'),
        'UT_003' => env('Cashier', 'Cashier'),
        'UT_004' => env('Agent', 'Agent'),
    ],

    'user_status' => [
        '1' => env('Active', 'Active'),
        '2' => env('Blocked', 'Blocked'),
        '6' => env('In-Active', 'In-Active'),
    ],

    'statuses' => [
        '1' => env('Active', 'Active'),
    ],

    'doc_status' => [
        'Pending' => 0,
        'Approved' => 1,
        'Rejected' => 2,
    ],

    'application_status' => [
        'Pending' => 3,
        'Failed' => 2,
        'Passed' => 1,
    ],

    'theme_mode' => [
        'light' => 
            [
                'sidebar' => 'sidebar-light-info',
                'body' => '',
                'icon' => 'fas',
            ],
        'dark' => [
            'sidebar' => 'sidebar-dark-info',
            'body' => 'dark-mode',
            'icon' => 'far'
        ],
    ],

    'messages' => [
        'default' => 'Cannot continue, please call system administrator!',
    ],

];