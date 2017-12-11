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
        return 'reverse.do';
    }
}