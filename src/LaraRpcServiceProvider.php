<?php
/**
 * Created by PhpStorm.
 * User: evan
 * Date: 2018/7/26
 * Time: 上午9:40
 */

namespace LaraRpc;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use LaraRpc\Facdes\LaraRpcServer;

class LaraRpcServiceProvider extends ServiceProvider
{

    public function boot()
    {
        // Publish config file setup
        $this->publishes([
            __DIR__.'../config/rpc.php' => config_path('rpc.php'),
        ],'laravel-rpc');

        // Register Facades
        $loader = AliasLoader::getInstance();
        $loader->alias('LaraRpcClient', HttpRpcClient::class);
        $loader->alias('LaraRpcServer', LaraRpcServer::class);

        // set router
        $this->setupRoutes($this->app->router);
    }

    /**
     * Register the application services.
     *
     * @return void
     * @author LaravelAcademy.org
     */
    public function register()
    {

        $this->app->bind('LaraRpcClient',function($app,$params = []){
            return new RpcClientManager($this->app);
        });

        $this->app->singleton('LaraRpcServer',function($app,$params = []){
            return new RpcServerManager();
        });
    }

    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'LaraRpc'],function($router){
            if(! $this->app->routesAreCached()){
                require __DIR__ . '/../router/rpc_api.php';
            }
        });

    }

}
