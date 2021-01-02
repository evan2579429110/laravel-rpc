<?php

Route::post( 'api/rpc/server', function (){
    \LaraRpc\Facdes\HttpRpcServer::server();
});
