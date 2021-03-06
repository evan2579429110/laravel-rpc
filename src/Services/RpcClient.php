<?php

namespace LaraRpc\Services;

use LaraRpc\Interfaces\RpcClientInterface;
use Hprose\Future;


abstract class RpcClient implements RpcClientInterface
{

    protected $method = 'execute';

    protected $options = [];


    public function __construct($options)
    {
        $this->options = $options;
        // 检测首字母是否包含/，不包含则添加
        $this->setRouter();
    }


    /**
     * 设置请求
     * @param $method
     * @param string $func
     */
    public function request($method = '')
    {
        $this->options['method'] = $method;
        !empty($func)?$this->execute($func):'';
        return $this;
    }

    /**
     * 获取路由
     * @param string $route
     */
    public function route($route = '')
    {
        $this->options['route'] = $route;
        return $this;
    }

    /**
     * 设置header
     * @param $headers
     */
    public function header($headers)
    {
        $this->options['headers'] = $headers;
        return $this;
    }


    /**
     * 设置路由
     * @return mixed
     */
    abstract function setRouter();

    /**
     * 开始执行
     * @param $data
     * @return mixed
     */
    abstract function start($data);

    /**
     * 设置func名称
     * @param $name
     */
    function execute($name)
    {
        $this->method = $name;
        return $this;
    }

    /**
     * 开启debug
     * @param $client
     */
    protected function setDebug($client,$url)
    {

        if ($this->options['debug']){
            var_dump($url);
            $logHandler = function($name, array &$args, $context,$next) {
                var_dump("before invoke");
                var_dump("method:".$name.',params:'.var_export($args, true));
                $result = $next($name, $args, $context);
                var_dump("after invoke:");
                if (Future\isFuture($result)) {
                    $result->then(function($result) {
                        var_dump(var_export($result, true));
                    });
                }
                else {
                    var_dump(var_export($result, true));
                }
                return $result;
            };

            $client->addInvokeHandler($logHandler);
        }
    }
}