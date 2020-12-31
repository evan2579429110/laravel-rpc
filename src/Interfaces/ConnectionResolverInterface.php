<?php

namespace LaraRpc\Interfaces;

interface ConnectionResolverInterface
{

    public function connection($name = null);


    public function getDefaultConnection();


//    public function setDefaultConnection($name);
}
