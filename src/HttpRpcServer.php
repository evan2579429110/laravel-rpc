<?php


namespace LaraRpc;

use Hprose\Swoole\Http\Server;

class HttpRpcServer extends RpcServer
{

    public function server($params)
    {
        $server = new Server();
        $funcName = (isset($params['funcName']) && !empty($params['funcName']))?new $params['funcName']():$this;
        $server->addMethod($params['methodName'], $funcName);
        $server->start();
    }




}