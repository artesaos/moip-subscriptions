<?php

namespace Artesaos\MoIPSubscriptions\Resources;

use Artesaos\Restinga\Data\Resource;
use Artesaos\Restinga\Http\Format\Receive\ReceiveJson;
use Artesaos\Restinga\Http\Format\Receive\ReceiveJsonErrors;
use Artesaos\Restinga\Http\Format\Send\SendJson;

class Plan extends Resource
{
    // send and receive data in JSON.
    use SendJson, ReceiveJson;
    
    // receive errors in JSON.
    use ReceiveJsonErrors;

    // registered service
    protected $service = 'moip-subscriptions';

    // resource name
    protected $name = 'plans';

    // resource identifier
    protected $identifier = 'code';

    // resource collection root
    protected $collection_root = 'plans';

    // empty resource name when single item
    protected $item_root = null;

    // errors root
    protected $errors_root = 'errors';

    /**
     * Activate a Plan.
     * 
     * @return bool
     */
    public function activate()
    {
        return $this->makeRequest('put', true, '/activate');
    }

    /**
     * Inactivate a Plan.
     * 
     * @return bool
     */
    public function inactivate()
    {
        return $this->makeRequest('put', true, '/inactivate');
    }
}