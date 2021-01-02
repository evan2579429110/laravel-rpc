<?php


namespace LaraRpc;

use Hprose\Http\Server;
use Hprose\Future;
use Illuminate\Support\Facades\App;

class HttpRpcServer extends RpcServer
{

    protected $options;

    protected $data;

    protected $headers;

    public function server()
    {
        $server = new Server();
        $class = App::make($this->options['className']);
        $server->addMethod($this->options['method'], $class);
        $server->start();
    }




}