<?php


namespace LaraRpc;

use Hprose\Http\Client;


class HttpRpcClient extends RpcClient
{

    private $options = [];

    public function __construct($options)
    {
        $this->options = $options;
    }

    public function start($data)
    {
        $sync = isset($data['sync'])?$data['sync']:$this->options['sync'];
        $client = new Client($this->options['host'], $sync);

        foreach ($this->options['headers'] as $headerKey =>$value) {
            $client->setHeader($headerKey, $value);
        }
        return $client->{$this->options['methodName']}($data);
    }



}