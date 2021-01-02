<?php

namespace LaraRpc;

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
        $this->options['method'] = isset($this->options['alias'])?$this->options['alias']:$this->options['method'];
        $this->headers = request()->headers;
    }


}
