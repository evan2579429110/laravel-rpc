<?php


namespace LaraRpc;

use App\Http\Controllers\HproseController;
use Hprose\Http\Server;

class RpcServerManager
{
    private $options;


    public function __construct()
    {
        $params = request()->all();
        $this->options = config('rpc.server')[$params['method']];
        $this->options['method'] = $params['method'];
    }

    public function server()
    {
        // 如果不存在会根据请求地址获取
        $driver = isset($this->options['driver'])?$this->options['driver']:'';
        switch ($driver){
            case 'http':
                $server = new HttpRpcServer($this->options);
                break;
            default:
                throw new \Exception("不存在的请求类型，请检查");
        }
        $server->server();

    }



}