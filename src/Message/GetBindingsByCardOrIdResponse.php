<?php

namespace Omnipay\Sberbank\Message;

/**
 * Class GetBindingsByCardOrIdResponse
 * @package Omnipay\Sberbank\Message
 */
class GetBindingsByCardOrIdResponse extends GetBindingsResponse
{
    /**
     * Number (identifier) of the client in the merchant system.
     *
     * @param $binding_index
     * @return mixed|null
     */
    public function getClientId($binding_index)
    {
        $binding = $this->getBinding();
        return array_key_exists('clientId', $binding[$binding_index]) ? $binding[$binding_index]['clientId'] : null;
    }
}
