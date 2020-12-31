<?php


use LaraRpc\Facdes\LaraRpcClient;
use LaraRpc\Interfaces\RpcClientInterface;

class RpcClientTest
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testQuery(RpcClientInterface $client)
    {
        echo phpinfo();exit;

        $client->request('class','func')->data();
//        LaraRpc\Facdes\LaraRpcClient::getServer();

    }
}
