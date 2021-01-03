<?php


namespace LaraRpc\Services\Socket;

use Hprose\Socket\Client;
use LaraRpc\Services\RpcClient;

class SocketRpcClient extends RpcClient
{

    protected $options = [];

    /**
     * 设置默认路由
     */
    public function setRouter()
    {
        if (!isset($this->options['route'])){
            $this->options['route'] = '/tcp/rpc/server';
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
        $url = $this->options['host'].':'.$this->options['port'].$this->options['route']
            .'?method='.$this->options['method'];
        //validate url
        $this->validateUrl($url);

        if ($this->options['driver'] == 'tcp'){
            $client = new Client($url,false);
        }elseif($this->options['driver'] == 'unix'){
            $client = new Client($url);
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
        $driver = explode(":",$url)[0];
        if ($driver === $this->options['driver']){
            return true;
        }else{
            throw new \Exception('Tcp类型匹配不一致:'.$driver);
        }
    }


}