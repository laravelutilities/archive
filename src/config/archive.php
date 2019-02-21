<?php

return [
    'format_datetime' => 'epoch',
    'run'             => 'daily',
    'keep'            => '45 DAY',
    'created_at_field'=> 'created_at',
    'tables'          => [
        'workflow.sms_api_response_packets',
        'workflow.email_api_response_packets'
    ],
    'connections'     => [
        'archive' => [
            'driver'    => 'mysql',
            'host'      => env('ARCHIVE_DB_HOST', 'localhost'),
            'database'  => env('ARCHIVE_DB_DATABASE', 'archive'),
            'username'  => env('ARCHIVE_DB_USERNAME', 'root'),
            'password'  => env('ARCHIVE_DB_PASSWORD', 'root'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ]
    ]
];

