<?php

namespace Omnipay\Sberbank\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

abstract class AbstractRequest extends BaseAbstractRequest
{
    /**
     * Get live- or testURL.
     */
    public function getUrl()
    {
        if ($this->getTestMode()) {
            return 'https://3dsec.sberbank.ru/payment/rest';
        } else {
            return 'https://securepayments.sberbank.ru/payment/rest';
        }
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * @param $value
     * @return BaseAbstractRequest
     */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->getParameter('userName');
    }

    /**
     * @param $value
     * @return BaseAbstractRequest
     */
    public function setUserName($value)
    {
        return $this->setParameter('userName', $value);
    }

}