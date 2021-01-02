<?php

namespace LaraRpc;

use LaraRpc\Interfaces\RpcClientInterface;
use Hprose\Http\Client;
use Hprose\Http\Server;
use Hprose\Future;


abstract class RpcClient implements RpcClientInterface
{

    protected $method = 'execute';

    protected $options = [];


    public function __construct($options)
    {
        $this->options = $options;
        // 检测首字母是否包含/，不包含则添加
        if ($this->options['route'][0] != '/'){
            $this->options['route'] = '/'.$this->options['route'];
        }
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

    abstract function start($data);

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
        $this->method = $name;
    }

    protected function setDebug($client)
    {

        if ($this->options['debug']){
            $logHandler = function($name, array &$args, $context,$next) {
                var_dump("before invoke:method".$name.',params:'.var_export($args, true));
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


//    public function __call($name, $arguments)
//    {
//        echo '----call---';
////        $this->request($name,$arguments);
//    }

//    public static function __callStatic($name, $arguments)
//    {
//        echo '----callstatic---';
//
////        $query = new self();
//        // TODO: Implement __callStatic() method.
//    }


}