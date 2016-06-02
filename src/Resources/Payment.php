<?php

namespace Artesaos\MoIPSubscriptions\Resources;

use Artesaos\Restinga\Data\Resource;
use Artesaos\Restinga\Http\Format\Receive\ReceiveJson;
use Artesaos\Restinga\Http\Format\Receive\ReceiveJsonErrors;
use Artesaos\Restinga\Http\Format\Send\SendJson;

/**
 * Class Payment.
 *
 * @property    int     id                  Identificador do Pagamento.
 * @property    int     moip_id             Identificador Interno do Pagamento.
 * @property    array   status              Status do Pagamento.
 * @porperty    array   payment_method      Método do Pagamento.
 */
class Payment extends Resource
{
    // send and receive data in JSON.
    use SendJson, ReceiveJson;

    // receive errors in JSON.
    use ReceiveJsonErrors;

    // registered service
    protected $service = 'moip-subscriptions';

    // resource name
    protected $name = 'payments';

    // resource identifier
    protected $identifier = 'id';

    // resource collection root
    protected $collection_root = 'payments';

    // empty resource name when single item
    protected $item_root = null;
}
