<?php

namespace Omnipay\Sberbank\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class ExtendedOrderStatusRequest
 * @package Omnipay\Sberbank\Message
 */
class ExtendedOrderStatusRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        if (!$this->getOrderId() && !$this->getOrderNumber()) {
            throw new InvalidRequestException("You must specify one of the parameters - orderId or orderNumber");
        }

        return $this->specifyAdditionalParameters([], ['orderId', 'orderNumber', 'language']);
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'getOrderStatusExtended.do';
    }

    /**
     * @return mixed
     */
    public function getOrderNumber()
    {
        return $this->getParameter('orderNumber');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setOrderNumber($value)
    {
        return $this->setParameter('orderNumber', $value);
    }
}
