<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "custom", "stack"
    |
    */

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['debug', 'stderr'],
        ],

        'debug' => [
            'driver' => 'single',
            'path' => storage_path(env('LOG_FILE_NAME','logs/lumen_'.Carbon\Carbon::now().'log')),
            'level' => 'debug',
        ],

        'docker' => [
            'driver' => 'docker',
            'application' => env('APPLICATION_NAME', 'UNSET'),
            'level' => env('LOG_LEVEL', 'info'),
        ],
        'stderr' => [
            'driver' => 'monolog',
            'handler' => \Monolog\Handler\StreamHandler::class,
            'with' => [
                'stream' => 'php://stderr',
            ]
        ]
    ],

];
