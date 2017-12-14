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
        return array_key_exists('binding', $this->data) ? $this->data['binding'] : [];
    }

    /**
     * The identifier of the bundle created when the order was paid or used for payment.
     *
     * Is present only if the magazine is allowed to create bundles.
     *
     * @return mixed|null
     */
    public function getBindingId()
    {
        $binding = $this->getBinding();
        return array_key_exists('bindingId', $binding) ? $binding['bindingId'] : null;
    }

    /**
     * Masked card number that was used for payment.
     *
     * Specified only after payment of the order.
     *
     * @return mixed|null
     */
    public function getMaskedPan()
    {
        $binding = $this->getBinding();
        return array_key_exists('maskedPan', $binding) ? $binding['maskedPan'] : null;
    }

    /**
     * The expiration date of the card in the format YYYYMM.
     *
     * Specified only after payment of the order.
     *
     * @return mixed|null
     */
    public function getExpiryDate()
    {
        $binding = $this->getBinding();
        return array_key_exists('expiryDate', $binding) ? $binding['expiryDate'] : null;
    }
}
