<?php

namespace LaraRpc\Facdes;

use Illuminate\Support\Facades\Facade;

class HttpRpcServer extends Facade {

    protected static function getFacadeAccessor() {
        return 'HttpRpcServer';
    }

}
