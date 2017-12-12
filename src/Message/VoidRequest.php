<?php

namespace Omnipay\Sberbank\Message;

class VoidRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('userName', 'password', 'orderId');

        $data = [
            'userName' => $this->getUserName(),
            'password' => $this->getPassword(),
            'orderId' => $this->getOrderId(),
        ];

        return $this->specifyAdditionalParameters($data, ['language']);
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'reverse.do';
    }
}
