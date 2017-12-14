<?php

namespace Omnipay\Sberbank\Message;

/**
 * Class VoidRequest
 * @package Omnipay\Sberbank\Message
 */
class VoidRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('orderId');

        $data = [
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
