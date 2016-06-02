<?php

namespace Artesaos\MoIPSubscriptions\Resources;

use Artesaos\Restinga\Data\Resource;
use Artesaos\Restinga\Http\Format\Receive\ReceiveJson;
use Artesaos\Restinga\Http\Format\Receive\ReceiveJsonErrors;
use Artesaos\Restinga\Http\Format\Send\SendJson;

/**
 * Class Coupon.
 *
 * @property    string  code                Código do cupon.
 * @property    string  name                Nome do cupon.
 * @property    string  description         Descrição do cupon.
 * @property    array   discount            Disconto configurado no cupon.
 * @property    string  status              Status do cupon.
 * @property    array   duration            Duração do cupon.
 * @property    array   expiration_date     Data de expiração do cupon.
 * @property    int     max_redemptions     Número Máximo de vezes que o cupon pode ser usado.
 * @property    boolean in_use              Indica se o cupon está em uso.
 * @property    array   creation_date       Data de criação do cupon.
 */
class Coupon extends Resource
{
    // send and receive data in JSON.
    use SendJson, ReceiveJson;

    // receive errors in JSON.
    use ReceiveJsonErrors;

    // registered service
    protected $service = 'moip-subscriptions';

    // resource name
    protected $name = 'coupons';

    // resource identifier
    protected $identifier = 'code';

    // resource collection root
    protected $collection_root = 'coupons';

    // empty resource name when single item
    protected $item_root = null;

    /**
     * Activate a Coupon.
     *
     * @return bool
     */
    public function activate()
    {
        return $this->makeRequest('put', true, '/active');
    }

    /**
     * Inactivate a Plan.
     *
     * @return bool
     */
    public function inactivate()
    {
        return $this->makeRequest('put', true, '/inactive');
    }
}
