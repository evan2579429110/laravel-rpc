<?php
/**
 * Created by PhpStorm.
 * User: evan
 * Date: 2018/7/26
 * Time: 上午9:40
 */

namespace LaraRpc;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use LaraRpc\Facdes\LaraRpcClient;
use LaraRpc\Facdes\LaraRpcServer;
use LaraRpc\Interfaces\RpcClientInterface;


class LaraRpcServiceProvider extends ServiceProvider
{

    public function boot()
    {
        // Publish config file setup
        $this->publishes([
            __DIR__.'/../config/rpc.php' => config_path('rpc.php'),
        ]);

        // Register Facades
        $loader = AliasLoader::getInstance();
        $loader->alias('LaraRpcClient', LaraRpcClient::class);
        $loader->alias('LaraRpcServer', LaraRpcServer::class);

    }

    /**
     * Register the application services.
     *
     * @return void
     * @author LaravelAcademy.org
     */
    public function register()
    {
        $this->app->singleton('HttpRpcClient',function($app,$params = []){
            return new RpcClientManager($this->app);
        });

        $this->app->singleton('HttpRpcServer',function($app,$params = []){
            return new HttpRpcServer();
        });
    }

}
