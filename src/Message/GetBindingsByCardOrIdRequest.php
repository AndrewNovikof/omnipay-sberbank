<?php

namespace Omnipay\Sberbank\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class GetBindingsByCardOrIdRequest
 * @package Omnipay\Sberbank\Message
 */
class GetBindingsByCardOrIdRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        if (!$this->getBindingId() && !$this->getPan()) {
            throw new InvalidRequestException("You must specify one of the parameters - orderId or pan");
        }

        return $this->specifyAdditionalParameters([], ['bindingId', 'pan', 'showExpired']);
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'getBindingsByCardOrId.do';
    }

    /**
     * Get identifier of the bundle created when the order was paid or used for payment.
     *
     * @return mixed
     */
    public function getBindingId()
    {
        return $this->getParameter('bindingId');
    }

    /**
     * Set identifier of the bundle created when the order was paid or used for payment. Required, if not specified pan.
     *
     * Is present only if the magazine is allowed to create bundles.
     *
     * @param $bindingId
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setBindingId($bindingId)
    {
        return $this->setParameter('bindingId', $bindingId);
    }

    /**
     * Get card number. Required if bindingId is not specified.
     *
     * @return mixed
     */
    public function getPan()
    {
        return $this->getParameter('pan');
    }

    /**
     * Set card number. Required if bindingId is not specified.
     *
     * Search for the full card number is available to stores only if you have the appropriate permission.
     *
     * @param $pan
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setPan($pan)
    {
        return $this->setParameter('pan', $pan);
    }

    /**
     * Get card number. Required if bindingId is not specified.
     *
     * @return mixed
     */
    public function getShowExpired()
    {
        return $this->getParameter('showExpired');
    }

    /**
     * Set card number. Required if bindingId is not specified.
     *
     * Search for the full card number is available to stores only if you have the appropriate permission.
     *
     * @param $showExpired
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setShowExpired($showExpired)
    {
        return $this->setParameter('showExpired', $showExpired);
    }
}
