<?php


namespace LaraRpc\Services\Http;

use Hprose\Http\Server;
use Illuminate\Support\Facades\App;
use LaraRpc\Services\RpcServer;

class HttpRpcServer extends RpcServer
{

    protected $options;

    protected $data;

    protected $headers;

    /**
     * server调用
     */
    public function server()
    {
        $server = new Server();
        $class = App::make($this->options['className']);
        $server->addMethod($this->options['method'], $class);
        $server->start();
    }




}