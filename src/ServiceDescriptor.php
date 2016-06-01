<?php

namespace Artesaos\MoIPSubscriptions;

use Artesaos\Restinga\Authorization\Basic;
use Artesaos\Restinga\Service\Descriptor;

class ServiceDescriptor extends Descriptor
{
    // service alias
    protected $service = 'moip-subscriptions';

    // api prefix
    protected $prefix;

    // api token
    protected $token;

    // api key
    protected $key;

    // constructor
    public function __construct($token, $key, $production = false)
    {
        $this->token = $token;
        $this->key = $key;

        if ($production) {
            $this->prefix = 'https://api.moip.com.br/assinaturas/v1';
        } else {
            $this->prefix = 'https://sandbox.moip.com.br/assinaturas/v1';
        }
    }

    // how to authenticate on the api
    public function authorization()
    {
        return new Basic($this->token, $this->key);
    }
}