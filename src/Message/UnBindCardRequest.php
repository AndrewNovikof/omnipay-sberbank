<?php

namespace Omnipay\Sberbank\Message;

/**
 * Class UnBindCardRequest
 * @package Omnipay\Sberbank\Message
 */
class UnBindCardRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('bindingId');

        $data = [
            'bindingId' => $this->getBindingId()
        ];

        return $data;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'unBindCard.do';
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
     * Set identifier of the bundle created when the order was paid or used for payment.
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
}
