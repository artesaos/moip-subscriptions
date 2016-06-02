<?php

namespace Artesaos\MoIPSubscriptions\Resources;

use Artesaos\Restinga\Data\Resource;
use Artesaos\Restinga\Http\Format\Receive\ReceiveJson;
use Artesaos\Restinga\Http\Format\Receive\ReceiveJsonErrors;
use Artesaos\Restinga\Http\Format\Send\SendJson;

/**
 * Class Plan.
 *
 * @property    string  code            Identificador do plano na sua aplicação.
 * @property    string  name            Nome do plano na sua aplicação.
 * @property    string  description     Descrição do plano.
 * @property    int     amount          Valor do plano a ser cobrado em centavos de Real.
 * @property    int     setup_fee       Taxa de contratação a ser cobrada na assinatura em centavos de Real.
 * @property    array   interval        Estrutura de intervalo do plano contendo "unit" e "length".
 * @property    int     billing_cycles  Quantidade de ciclos (faturas) que a assinatura terá até expirar (se não informar, não haverá expiração)
 * @property    array   trial           Estrutura de trial, contendo "days", "enabled" e "hold_setup_fee".
 * @property    string  status          Status do plano. Pode ser ACTIVE ou INACTIVE. O default é ACTIVE.
 * @property    int     max_quantity    Quantidade máxima de assinaturas do plano (se não informado, não haverá limite).    integer(11)
 * @property    string  payment_method  Formas de pagamentos aceitas no plano. BOLETO, CREDIT_CARD ou ALL. default: CREDIT_CARD.
 */
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
