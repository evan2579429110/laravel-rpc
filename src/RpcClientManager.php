<?php

namespace LaraRpc;

use LaraRpc\Interfaces\ConnectionResolverInterface;

class RpcClientManager implements ConnectionResolverInterface
{
    private $app; // laravel app

    private $connections = [];

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function connection($name = null)
    {
        $name = $name?:$this->getDefaultConnection();
        // 如果
        if (! isset($this->connections[$name])) {
            $this->connections[$name] = $this->makeConnection($name);
        }

        return $this->connections[$name];
    }

    /**
     * 获取默认连接
     * @return mixed
     */
    public function getDefaultConnection()
    {
        return config('rpc.default');
    }

    protected function dirver()
    {
        return 'http';
    }


    /**
     * 创建连接
     * @param $name
     * @return HttpRpcClient
     * @throws \Exception
     */
    protected function makeConnection($name)
    {
        $config = config('rpc.client')[$name];
        $config['driver'] = $config['driver']?:$this->dirver();

        if ($resolver = Connection::getResolver($config['driver'])) {
            return $resolver($config['driver']);
        }
        switch ($config['driver']) {
            case 'http':
                return new HttpRpcClient($config);
                break;
            default :
                throw new \Exception('非法driver异常，请检查');
        }
    }

    /**
     * Dynamically pass methods to the default connection.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->connection()->$method(...$parameters);
    }

}