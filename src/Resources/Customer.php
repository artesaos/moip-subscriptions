<?php

namespace Artesaos\MoIPSubscriptions\Resources;

use Artesaos\Restinga\Data\Resource;
use Artesaos\Restinga\Http\Format\Receive\ReceiveJson;
use Artesaos\Restinga\Http\Format\Receive\ReceiveJsonErrors;
use Artesaos\Restinga\Http\Format\Send\SendJson;

class Customer extends Resource
{
    // send and receive data in JSON.
    use SendJson, ReceiveJson;
    
    // receive errors in JSON.
    use ReceiveJsonErrors;

    // registered service
    protected $service = 'moip-subscriptions';

    // resource name
    protected $name = 'customers';

    // resource identifier
    protected $identifier = 'code';

    // resource collection root
    protected $collection_root = 'customers';

    // empty resource name when single item
    protected $item_root = null;

    /**
     * Overload the URL if a credit card is being passed.
     *
     * @return $this|bool
     */
    public function save()
    {
        if (array_key_exists('billing_info', $this->attributes)
            &&
            array_key_exists('credit_card', $this->attributes['billing_info'])) {
            $this->name = 'customers?new_vault=true';
        } else {
            $this->name = 'customers?new_vault=false';
        }

        return parent::save();
    }

    /**
     * @param $holderName
     * @param $cardNumber
     * @param $expirationMonth
     * @param $expirationYear
     * @return bool
     */
    public function updateCreditCard($holderName, $cardNumber, $expirationMonth, $expirationYear)
    {
        $cardData = [
            'credit_card' => [
                'holder_name' => $holderName,
                'number' => $cardNumber,
                'expiration_month' => $expirationMonth,
                'expiration_year' => $expirationYear,
            ],
        ];
        return $this->makeRequest('put', true, '/billing_infos', json_encode($cardData));
    }
}