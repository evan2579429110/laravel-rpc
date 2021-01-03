<?php

namespace LaraRpc\Facdes;

use Illuminate\Support\Facades\Facade;

class LaraRpcClient extends Facade {

    protected static function getFacadeAccessor() {
        return 'LaraRpcClient';
    }

}
