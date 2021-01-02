<?php


namespace LaraRpc;

use Hprose\Http\Client;
use function PHPUnit\Framework\returnArgument;

class HttpRpcClient extends RpcClient
{

    protected $options = [];


    public function start($data)
    {
        $sync = isset($data['sync'])?$data['sync']:$this->options['sync'];
        $url = $this->options['host'].':'.$this->options['port'].$this->options['route']
            .'?method='.$this->options['method'];

        $client = new Client($url, $sync);

        foreach ($this->options['headers'] as $headerKey =>$value) {
            $client->setHeader($headerKey, $value);
        }
        $this->setDebug($client);
        return $client->{$this->options['method']}($data);
    }



}