<?php

namespace Omnipay\Sberbank\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class ExtendedOrderStatusRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('userName', 'password');

        if (!$orderId = $this->getOrderId() && !$oderNumber = $this->getOrderNumber()) {
            throw new InvalidRequestException("You must specify one of the parameters - orderId or orderNumber");
        }

        $data = [
            'userName' => $this->getUserName(),
            'password' => $this->getPassword(),
        ];

        $additionalParams = [
            'orderId',
            'orderNumber',
            'language'
        ];

        $this->specifyAdditionalParameters($data, $additionalParams);
        return $data;
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