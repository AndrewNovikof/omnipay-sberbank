<?php

namespace Omnipay\Sberbank\Message;

class CompleteAuthorizeRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('userName', 'password', 'orderNumber', 'amount');

        $data = [
            'userName' => $this->getUserName(),
            'password' => $this->getPassword(),
            'orderNumber' => $this->getOrderNumber(),
            'amount' => $this->getAmount(),
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