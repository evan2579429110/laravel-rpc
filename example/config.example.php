<?php

return [
    'default' => env('CLIENT_CONNECTION', 'default'),
    'client' => [
        'default' => [
            'driver' => env('RPC_DRIVER','http'), //请求类型，暂定只有http
            'host' => env('RPC_HOST','http://192.168.102.14'), //server端地址
            'port' => env('RPC_PORT','80'), //port
            'sync' => env('RPC_SYNC',false), // 异步1/同步0
            /**
             * Enable debug output to the php error log
             */
            'debug' => env('RPC_DEBUG', true),
        ]
    ],
    'server' => [
        'test' => [
            'driver' => env('RPC_DRIVER','http'),
        ]
    ]
];
