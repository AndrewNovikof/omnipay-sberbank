<?php

namespace Omnipay\Sberbank\Message;

class ExtendBindingRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('userName', 'password', 'bindingId', 'newExpiry');

        $data = [
            'userName' => $this->getUserName(),
            'password' => $this->getPassword(),
            'bindingId' => $this->getBindingId(),
            'newExpiry' => $this->getNewExpiry()
        ];

        return $this->specifyAdditionalParameters($data, ['language']);
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'extendBinding.do';
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

    /**
     * Get new date (year and month) of expiration in the format YYYYMM
     *
     * @return mixed
     */
    public function getNewExpiry()
    {
        return $this->getParameter('newExpiry');
    }

    /**
     * Set new date (year and month) of expiration in the format YYYYMM
     *
     * @param $newExpiry
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setNewExpiry($newExpiry)
    {
        return $this->setParameter('newExpiry', $newExpiry);
    }
}
