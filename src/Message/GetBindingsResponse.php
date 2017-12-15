<?php

namespace Omnipay\Sberbank\Message;

/**
 * Class GetBindingsResponse
 * @package Omnipay\Sberbank\Message
 */
class GetBindingsResponse extends AbstractResponse
{
    /**
     * @return array
     */
    public function getBinding()
    {
        return array_key_exists('bindings', $this->data) ? $this->data['bindings'] : [];
    }

    /**
     * The identifier of the bundle created when the order was paid or used for payment.
     *
     * Is present only if the magazine is allowed to create bundles.
     *
     * @param $binding_index
     * @return mixed|null
     */
    public function getBindingId($binding_index)
    {
        $binding = $this->getBinding();
        return array_key_exists('bindingId', $binding[$binding_index]) ? $binding[$binding_index]['bindingId'] : null;
    }

    /**
     * Masked card number that was used for payment.
     *
     * Specified only after payment of the order.
     *
     * @param $binding_index
     * @return mixed|null
     */
    public function getMaskedPan($binding_index)
    {
        $binding = $this->getBinding();
        return array_key_exists('maskedPan', $binding[$binding_index]) ? $binding[$binding_index]['maskedPan'] : null;
    }

    /**
     * The expiration date of the card in the format YYYYMM.
     *
     * Specified only after payment of the order.
     *
     * @param $binding_index
     * @return mixed|null
     */
    public function getExpiryDate($binding_index)
    {
        $binding = $this->getBinding();
        return array_key_exists('expiryDate', $binding[$binding_index]) ? $binding[$binding_index]['expiryDate'] : null;
    }
}
