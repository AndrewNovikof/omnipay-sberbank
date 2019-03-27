<?php

namespace Omnipay\Sberbank\Message;


use Omnipay\Common\Exception\InvalidRequestException;

class OrderReceiptStatusRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        if (!$this->getOrderId() && !$this->getOrderNumber()) {
            throw new InvalidRequestException('You must specify one of the parameters - orderId or orderNumber');
        }

        return $this->specifyAdditionalParameters([], ['orderId', 'orderNumber', 'language', 'uuid']);
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'getReceiptStatus.do';
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

    /**
     * Get receipt ID in the fiscalizer
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->getParameter('uuid');
    }

    /**
     * Set receipt ID in the fiscalizer
     *
     * @param string $value
     *
     * @return OrderReceiptStatusRequest
     */
    public function setUuid($value)
    {
        return $this->setParameter('uuid', $value);
    }
}