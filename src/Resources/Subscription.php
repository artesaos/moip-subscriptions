<?php

namespace Artesaos\MoIPSubscriptions\Resources;

use Artesaos\Restinga\Data\Resource;
use Artesaos\Restinga\Http\Format\Receive\ReceiveJson;
use Artesaos\Restinga\Http\Format\Receive\ReceiveJsonErrors;
use Artesaos\Restinga\Http\Format\Send\SendJson;

/**
 * Class Subscription.
 *
 * @property    string  code                Identificador da assinatura na sua aplicação.
 * @property    int     amount              Valor da assinatura (sobrescreve o valor do plano contratado).
 * @property    array   plan                Node de informações do plano que será usado na assinatura.
 * @property    array   customer            Node de informações do cliente que será o assinante.
 * @property    array   creation_date       Data de Criação da Assinatura.
 * @property    string  status              Status do Plano.
 * @property    array   expiration_date     Data de Expiração do Plano.
 * @property    array   next_invoice_date   Data da Próxima Fatura.
 * @property    array   trial               Informações sobre o Trial.
 * @property    string  payment_method      Método de Pagamento da assinatura.
 */
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

    /**
     * @return bool
     */
    public function suspend()
    {
        return $this->makeRequest('put', true, '/suspend');
    }

    /**
     * @return bool
     */
    public function activate()
    {
        return $this->makeRequest('put', true, '/activate');
    }

    /**
     * @return bool
     */
    public function cancel()
    {
        return $this->makeRequest('put', true, '/cancel');
    }

    /**
     * @return array
     */
    public function getInvoices()
    {
        return $this->childResource(new Invoice())->getAll();
    }
}
