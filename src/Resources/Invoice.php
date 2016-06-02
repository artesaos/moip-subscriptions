<?php

namespace Artesaos\MoIPSubscriptions\Resources;

use Artesaos\Restinga\Data\Resource;
use Artesaos\Restinga\Http\Format\Receive\ReceiveJson;
use Artesaos\Restinga\Http\Format\Receive\ReceiveJsonErrors;
use Artesaos\Restinga\Http\Format\Send\SendJson;

class Invoice extends Resource
{
    // send and receive data in JSON.
    use SendJson, ReceiveJson;
    
    // receive errors in JSON.
    use ReceiveJsonErrors;

    // registered service
    protected $service = 'moip-subscriptions';

    // resource name
    protected $name = 'invoices';

    // resource identifier
    protected $identifier = 'id';

    // resource collection root
    protected $collection_root = 'invoices';

    // empty resource name when single item
    protected $item_root = null;

    public function suspend()
    {
        return $this->makeRequest('put', true, '/suspend');
    }

    public function activate()
    {
        return $this->makeRequest('put', true, '/activate');
    }

    public function cancel()
    {
        return $this->makeRequest('put', true, '/cancel');
    }

    public function getPayments()
    {
        return $this->childResource(new Payment())->getAll();
    }
}