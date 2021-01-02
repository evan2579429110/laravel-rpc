<?php

namespace LaraRpc\Interfaces;


interface RpcClientInterface
{

    /**
     * 设置请求
     * @param $method
     * @param string $func
     */
    public function request($method = '');


    /**
     * 获取路由
     * @param string $route
     */
    public function route($route = '');


    /**
     * 开始执行
     * @param $data
     * @return mixed
     */
    public function start($data);
}