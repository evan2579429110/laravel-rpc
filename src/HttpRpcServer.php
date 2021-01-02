<?php


namespace LaraRpc;

use Hprose\Http\Server;
use Hprose\Future;

class HttpRpcServer extends RpcServer
{

    protected $options;

    protected $data;

    protected $headers;

    public function server()
    {
        $server = new Server();
        $class = new $this->options['className']();
        $server->addMethod($this->options['method'], $class);
        $server->start();
    }




}