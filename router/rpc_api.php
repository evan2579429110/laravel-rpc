<?php

use Hprose\Http\Server;
use Illuminate\Support\Facades\App;

$routing = config('rpc.auth')?['middleware' => ['rpc.auth']]:[];

Route::group($routing, function (){
    Route::post( 'api/rpc/server', function (){
        \LaraRpc\Facdes\LaraRpcServer::server();
    });
});

