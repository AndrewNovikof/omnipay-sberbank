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
     * @return mixed|null
     */
    public function getClientId()
    {
        $binding = $this->getBinding();
        return array_key_exists('clientId', $binding) ? $binding['clientId'] : null;
    }
}
