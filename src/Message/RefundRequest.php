<?php

namespace Omnipay\Sberbank\Message;

/**
 * Class RefundRequest
 * @package Omnipay\Sberbank\Message
 */
class RefundRequest extends AbstractRequest
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
        return 'refund.do';
    }
}
