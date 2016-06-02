<?php

namespace Artesaos\MoIPSubscriptions;

use Artesaos\Restinga\Container;

/**
 * Class MoIPSubscriptions.
 */
class MoIPSubscriptions
{
    /**
     * @param $token
     * @param $key
     * @param bool $production
     */
    public static function setCredentials($token, $key, $production = false)
    {
        $descriptor = new ServiceDescriptor($token, $key, $production);
        Container::register($descriptor);
    }
}
