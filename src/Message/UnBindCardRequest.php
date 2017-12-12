<?php

namespace Omnipay\Sberbank\Message;

class UnBindCardRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('userName', 'password', 'bindingId');

        $data = [
            'userName' => $this->getUserName(),
            'password' => $this->getPassword(),
            'bindingId' => $this->getBindingId()
        ];

        return $data;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'unBindCard.do';
    }

    /**
     * Get identifier of the bundle created when the order was paid or used for payment.
     *
     * @return mixed
     */
    public function getBindingId()
    {
        return $this->getParameter('bindingId');
    }

    /**
     * Set identifier of the bundle created when the order was paid or used for payment.
     *
     * Is present only if the magazine is allowed to create bundles.
     *
     * @param $bindingId
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setBindingId($bindingId)
    {
        return $this->setParameter('bindingId', $bindingId);
    }
}
