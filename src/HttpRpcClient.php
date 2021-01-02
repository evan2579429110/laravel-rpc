<?php


namespace LaraRpc;

use Hprose\Http\Client;

class HttpRpcClient extends RpcClient
{

    protected $options = [];

    /**
     * 开始执行
     * @param $data
     * @return mixed
     */
    public function start($data)
    {
        $sync = isset($data['sync'])?$data['sync']:$this->options['sync'];
        $url = $this->options['host'].':'.$this->options['port'].$this->options['route']
            .'?method='.$this->options['method'];

        $client = new Client($url, $sync);
        if (isset($this->options['headers'])){
            foreach ($this->options['headers'] as $headerKey =>$value) {
                $client->setHeader($headerKey, $value);
            }
        }
        $this->setDebug($client);
        return $client->{$this->options['method']}($data);
    }



}