<?php

namespace LaraRpc\Services;

use Hprose\Http\Server;
use LaraRpc\Interfaces\RpcServerInterface;

abstract class RpcServer implements RpcServerInterface
{

    protected $options;

    protected $data;

    protected $headers;

    public function __construct($options)
    {
        $this->options = $options;
        $this->headers = request()->headers;
    }



    abstract function server();

}
