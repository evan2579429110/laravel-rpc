# laravel-rpc

Table of Contents
=================

*[要求](#Requirements)
*[示例](#examples)
*[方法](#func)

## Requirements
php: 5.6 ~ 8.0
laravel: 5.1 ~ 8.0

## Examples

composer require evanyu/laravel-rpc

config/app.php中providers添加
``
 LaraRpc\LaraRpcServiceProvider::class
``       

php artisan vendor:publish


具体参考example文件
### client端

配置config/rpc.php文件client

``
HttpRpcClient::request('test')->start('hello world',true);
``

### server端

配置config/rpc.php文件server
``
创建func
``

##func


### client

设置请求方法
``
function request($method = '');
``


设置路由，默认 api/rpc/server
``
function route($route = '');
``

设置执行
``
function start($data);
``
