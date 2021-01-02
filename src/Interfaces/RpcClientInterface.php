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
     * 设置func名称
     * @param $name
     */
    public function execute($name);

    public function data();


}