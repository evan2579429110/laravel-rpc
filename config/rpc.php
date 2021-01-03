<?php

return [
    'default' => env('CLIENT_CONNECTION', 'http'),
    'auth' => env('RPC_AUTH',false),
    'client' => [
        'http' => [
            'driver' => 'http', //请求类型，暂定只有http
            'host' => env('RPC_HOST','http://192.168.102.14'), //server端地址
            'port' => env('RPC_PORT','80'), //port
            'sync' => env('RPC_SYNC',false), // 异步1/同步0
            /**
             * Enable debug output to the php error log
             */
            'debug' => env('RPC_DEBUG', true),
        ],
        // 支持高并发，也支持推送服务，但建议执行时间不要过长，因为会阻塞整个服务
        'tcp' => [
            'driver' => 'tcp', //未测试，暂不开放
            'host' => env('RPC_HOST','tcp://192.168.102.14'), //server端地址
            'port' => env('RPC_PORT','80'), //port
            /**
             * Enable debug output to the php error log
             */
            'debug' => env('RPC_DEBUG', true),
        ],
        'unix' => [
            'driver' => 'unix', // 暂不启用
            'host' => env('RPC_HOST','unix:/tmp/my.sock'), //server端地址
            'port' => env('RPC_PORT','80'), //port
            /**
             * Enable debug output to the php error log
             */
            'debug' => env('RPC_DEBUG', true),
        ],
//        'ws' => [
//            'driver' => 'ws', // 将只开发swoole版本，非swoole版本不开发
//            'host' => env('RPC_HOST','tcp://192.168.102.14'), //server端地址
//            'port' => env('RPC_PORT','80'), //port
//            /**
//             * Enable debug output to the php error log
//             */
//            'debug' => env('RPC_DEBUG', true),
//        ],
    ],
    'server' => [
        'aaa' => [
            'driver' => 'http',
//            'className' => \App\Services\TestService::class, // 支持intergace
        ],
        'bbb' => [
            'driver' => 'tcp',
//            'className' => '',
        ]
    ]
];
