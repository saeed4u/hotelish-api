<?php

use Monolog\Handler\StreamHandler;

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
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['single'],
        ],
        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
        ],
        'push' => [
            'driver' => 'single',
            'path' => storage_path('logs/push.log'),
            'level' => 'debug',
        ],
        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
            'days' => 7,
        ],
        'device' => [
            'driver' => 'daily',
            'path' => storage_path('logs/device/device.log'),
            'level' => 'debug',
            'days' => 7,
        ],
        'auth' => [
            'driver' => 'daily',
            'path' => storage_path('logs/auth/app-auth.log'),
            'level' => 'info',
            'days' => 7,
        ],
        'error' => [
            'driver' => 'daily',
            'path' => storage_path('logs/errors/app-error.log'),
            'level' => 'error',
            'days' => 7,
        ],
        'request_logs' => [
            'driver' => 'daily',
            'path' => storage_path('logs/requests/app-request.log'),
            'level' => 'info',
            'days' => 7,
        ],
        'queries' => [
            'driver' => 'daily',
            'path' => storage_path('logs/queries/app-queries.log'),
            'level' => 'info',
            'days' => 7,
        ],
        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Log',
            'emoji' => ':boom:',
            'level' => 'critical',
        ],

        'stderr' => [
            'driver' => 'monolog',
            'handler' => StreamHandler::class,
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => 'debug',
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => 'debug',
        ],
    ],

];
