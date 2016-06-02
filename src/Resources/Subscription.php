<?php

namespace Artesaos\MoIPSubscriptions\Resources;

use Artesaos\Restinga\Data\Resource;
use Artesaos\Restinga\Http\Format\Receive\ReceiveJson;
use Artesaos\Restinga\Http\Format\Receive\ReceiveJsonErrors;
use Artesaos\Restinga\Http\Format\Send\SendJson;

class Subscription extends Resource
{
    // send and receive data in JSON.
    use SendJson, ReceiveJson;
    
    // receive errors in JSON.
    use ReceiveJsonErrors;

    // registered service
    protected $service = 'moip-subscriptions';

    // resource name
    protected $name = 'subscriptions';

    // resource identifier
    protected $identifier = 'code';

    // resource collection root
    protected $collection_root = 'subscriptions';

    // empty resource name when single item
    protected $item_root = null;

    /**
     * Overload the URL if a credit card is being passed.
     *
     * @return $this|bool
     */
    public function save()
    {
        if (array_key_exists('customer', $this->attributes)
            &&
            array_key_exists('fullname', $this->attributes['customer'])) {
            $this->name = 'subscriptions?new_customer=true';
        } else {
            $this->name = 'subscriptions?new_customer=false';
        }

        return parent::save();
    }

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
    
    public function getInvoices()
    {
        return $this->childResource(new Invoice())->getAll();
    }
}