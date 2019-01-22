<?php

namespace Omnipay\Sberbank\Message;

/**
 * Class CaptureRequest
 * @package Omnipay\Sberbank\Message
 */
class CaptureRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('orderId', 'amount');

        $data = [
            'orderId' => $this->getOrderId(),
            'amount' => $this->getAmountInteger(),
        ];

        return $data;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'deposit.do';
    }
}
