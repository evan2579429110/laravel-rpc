<?php


use LaraRpc\HttpRpcClient;

class ClientExample
{
    public function client()
    {
        HttpRpcClient::request('test')->start('hello world');
    }

}