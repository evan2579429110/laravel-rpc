<?php

namespace LaraRpc;

use LaraRpc\Interfaces\RpcClientInterface;
use Hprose\Http\Client;
use Hprose\Http\Server;

abstract class RpcClient implements RpcClientInterface
{

    protected $func = 'execute';

    protected $options = [];

    /**
     * 设置请求
     * @param $method
     * @param string $func
     */
    public function request($funcName = '',$methodName = '')
    {
        $this->options['methodName'] = $methodName;
        $this->options['funcName'] = $funcName;
        !empty($func)?$this->execute($func):'';
    }

    public abstract function start($data);

    public function data()
    {
        $this->options['data'] = [];
    }

    public function header($headers)
    {
        $this->options['headers'] = $headers;
    }


    protected function getExecute()
    {
        return $this->func;
    }


    /**
     * 设置func名称
     * @param $name
     */
    public function execute($name)
    {
        $this->func = $name;
    }


    public function __call($name, $arguments)
    {
//        $this->request($name,$arguments);
    }

    public static function __callStatic($name, $arguments)
    {
//        $query = new self();
        // TODO: Implement __callStatic() method.
    }


}