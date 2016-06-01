<?php

namespace Artesaos\MoIPSubscriptions;

use Artesaos\Restinga\Container;

class MoIPSubscriptions
{
    public static function setCredentials($token, $key, $production = false)
    {
        $descriptor = new ServiceDescriptor($token, $key, $production);
        Container::register($descriptor);
    }
}