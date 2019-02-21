<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Format Datetime
      |--------------------------------------------------------------------------
      | Currently, this package is supporting epoch timestamp. In future, this 
      | will start supporting other format as well.
      | 
      | Note: For the time being, package is not using this configuration
     */
    'format_datetime' => 'epoch',
    
    /*
      |--------------------------------------------------------------------------
      | Keep
      |--------------------------------------------------------------------------
      | The data older than keep number of days will be sent to archive
      | 
      | Note: DATE_SUB(CURDATE(), INTERVAL " . config('archive.keep').") is being used 
     */
    'keep'            => '45 DAY',
    
    /*
      |--------------------------------------------------------------------------
      | Created_at Field
      |--------------------------------------------------------------------------
      | On the basis of field against which keep (above) is being calculated
      | 
     */
    'created_at_field'=> 'created_at',
    /*
      |--------------------------------------------------------------------------
      | Tables
      |--------------------------------------------------------------------------
      | Tables to be sent to archive
      | Strictly follow : database.table
      | 
      | 
     */
    'tables'          => [
        // 'database.table',
    ],
    
    /*
      |--------------------------------------------------------------------------
      | Connection
      |--------------------------------------------------------------------------
      | To Set the database connection
      | 
     */
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

