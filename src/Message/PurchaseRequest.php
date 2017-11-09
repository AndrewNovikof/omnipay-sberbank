<?php

namespace Omnipay\Sberbank\Message;

class PurchaseRequest extends AbstractRequest
{
    protected $endpoint = '/register.do';

    /**
     * @return array|mixed
     */
    public function getData()
    {
        $this->validate('username', 'password', 'orderNumber', 'amount', 'returnUrl');

        $data = [];
        $data['username'] = $this->getUserName();
        $data['password'] = $this->getPassword();
        $data['orderNumber'] = $this->getOrderNumber();
        $data['amount'] = $this->getAmountInteger();
        $data['returnUrl'] = $this->getReturnUrl();

        if ($currency = $this->getCurrency()) {
            $data['currency'] = $currency;
        }

        if ($failUrl = $this->getFailUrl()) {
            $data['failUrl'] = $currency;
        }

        if ($description = $this->getDescription()) {
            $data['description'] = $description;
        }

        if ($language = $this->getLanguage()) {
            $data['language'] = $language;
        }

        return $data;
    }

    /**
     * @return mixed
     */
    public function getOrderNumber()
    {
        return $this->getParameter('orderNumber');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setOrderNumber($value)
    {
        return $this->setParameter('orderNumber', $value);
    }

    /**
     * @return mixed
     */
    public function getFailUrl()
    {
        return $this->getParameter('failUrl');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setFailUrl($value)
    {
        return $this->setParameter('failUrl', $value);
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->getParameter('language');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setLanguage($value)
    {
        return $this->setParameter('language', $value);
    }

    /**
     * @param mixed $data
     * @return AuthorizeResponse
     */
    public function sendData($data)
    {
        return new AuthorizeResponse($this, $data);
    }
}