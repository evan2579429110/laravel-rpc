<?php


namespace LaraRpc\Services\Http;

use Hprose\Http\Client;
use LaraRpc\Services\RpcClient;

class HttpRpcClient extends RpcClient
{

    protected $options = [];

    /**
     * 设置默认路由
     */
    public function setRouter()
    {
        if (!isset($this->options['route'])){
            $this->options['route'] = '/api/rpc/server';
        }else if ($this->options['route'][0] != '/'){
            $this->options['route'] = '/'.$this->options['route'];
        }
    }

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
        //validate url
        $this->validateUrl($url);

        $client = new Client($url, $sync);

        if (isset($this->options['headers'])){
            foreach ($this->options['headers'] as $headerKey =>$value) {
                $client->setHeader($headerKey, $value);
            }
        }
        $this->setDebug($client,$url);
        return $client->{$this->options['method']}($data);
    }


    /**
     * 验证url是否有效
     * @param $url
     * @return bool
     */
    private function validateUrl($url)
    {
        return true;
    }


}