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
    public function start($arguments,$isTransform = false)
    {
        $url = $this->options['host'].':'.$this->options['port'].$this->options['route']
            .'?method='.$this->options['method'];
        //validate url
        $this->validateUrl($url);

        $client = new Client($url, $this->options['sync']);

        if (isset($this->options['headers'])){
            foreach ($this->options['headers'] as $headerKey =>$value) {
                $client->setHeader($headerKey, $value);
            }
        }
        $this->setDebug($client,$url);

        if (empty($arguments)){
            $data = [];
        }else{
            $data = $arguments;
        }

        $ret = $client->{$this->options['method']}(...$data);
        // 转换格式显示
        if ($isTransform){
            return $this->transformJson($ret);
        }else{
            return $ret;
        }
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

    /**
     * 判断是否是json
     * @param $ret
     * @return $ret
     */
    private function transformJson($ret) {
        if (is_string($ret)){
            return $this->isJsonString($ret);
        }elseif(is_array($ret)){
            $res = [];
            foreach ($ret as $key => $value){
                $res[$key] = $this->transformJson($value);
            }
            return $res;
        }else{
            return $ret;
        }
    }

    /**
     * 判断是否是json的String
     * @param String $string
     * @return bool
     */
    private function isJsonString(String $string) {
        return is_object(json_decode($string))?json_decode($string):$string;

    }

}