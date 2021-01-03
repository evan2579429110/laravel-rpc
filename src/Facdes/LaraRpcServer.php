<?php

namespace LaraRpc\Facdes;

use Illuminate\Support\Facades\Facade;

class LaraRpcServer extends Facade {

    protected static function getFacadeAccessor() {
        return 'LaraRpcServer';
    }

}
