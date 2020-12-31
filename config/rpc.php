<?php

return [
    'default' => env('CLIENT_CONNECTION', 'default'),
    'client' => [
        'default' => [
            'driver' => env('RPC_DRIVER','json'),
            'host' => env('RPC_HOST','localhost'), //host
            'port' => env('RPC_PORT','localhost'), //port
            'timeout' => env('RPC_TIMEOUT',60), // time
            'sync' => env('RPC_SYNC',false), // 异步1/同步0
            'headers' => [
//                'SJ_AUTH_TOKEN' =>  ''
            ], // 请求头
            /**
             * Enable debug output to the php error log
             */
            'debug' => env('RPC_DEBUG', false),

            /**
             * SSL certificates verification
             */
            'ssl_verify_peer' => env('RPC_SSL', true),
        ]
    ],
    'server' => []
];