<?php

namespace LaraRpc\Example;

use LaraRpc\HttpRpcClient;

class ServerExample
{
    public function test($name)
    {
        return $name;
    }

}