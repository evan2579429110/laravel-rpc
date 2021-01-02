<?php

namespace LaraRpc\Facdes;

use Illuminate\Support\Facades\Facade;

class HttpRpcClient extends Facade {

    protected static function getFacadeAccessor() {
        return 'HttpRpcClient';
    }

}
