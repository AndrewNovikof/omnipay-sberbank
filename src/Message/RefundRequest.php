<?php

namespace Omnipay\Sberbank\Message;

class RefundRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('userName', 'password', 'orderId', 'amount');

        $data = [
            'userName' => $this->getUserName(),
            'password' => $this->getPassword(),
            'orderId' => $this->getOrderId(),
            'amount' => $this->getAmount(),
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
