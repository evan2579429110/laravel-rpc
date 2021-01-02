<?php

return [
    'default' => env('CLIENT_CONNECTION', 'default'),
    'client' => [
        'default' => [
            'driver' => env('RPC_DRIVER','http'),
            'host' => env('RPC_HOST','http://192.168.102.14'), //host
            'port' => env('RPC_PORT','80'), //port
            'sync' => env('RPC_SYNC',false), // 异步1/同步0
            'route' => 'api/hprose/server',
            /**
             * Enable debug output to the php error log
             */
            'debug' => env('RPC_DEBUG', true),
        ]
    ],
    'server' => [
        'aaa' => [
            'driver' => env('RPC_DRIVER','http'),
//            'className' => '',
//            'alias' => 'aaa'
        ]
    ]
];
