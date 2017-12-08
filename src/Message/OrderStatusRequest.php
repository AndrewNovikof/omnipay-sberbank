<?php

namespace Omnipay\Sberbank\Message;

class OrderStatusRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('userName', 'password', 'orderNumber');

        $data = [
            'userName' => $this->getUserName(),
            'password' => $this->getPassword(),
            'orderNumber' => $this->getOrderNumber()
        ];

        if ($language = $this->getLanguage()) {
            $data['language'] = $language;
        }

        return $data;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'getOrderStatus.do';
    }
}