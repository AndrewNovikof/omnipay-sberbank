<?php

namespace Omnipay\Sberbank\Message;

class AuthorizeRequest extends AbstractRequest
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
        $data['orderNumber'] = $this->getTransactionId();
        $data['amount'] = $this->getAmountInteger();
        $data['returnUrl'] = $this->getReturnUrl();

        if ($currency = $this->getCurrency()) {
            $data['currency'] = $currency;
        }

        if ($failUrl = $this->getCancelUrl()) {
            $data['failUrl'] = $failUrl;
        }

        if ($description = $this->getDescription()) {
            $data['description'] = $description;
        }

        if ($language = $this->getLanguage()) {
            $data['language'] = $language;
        }

        if ($pageView = $this->getPageView()) {
            $data['pageView'] = $pageView;
        }

        if ($clientId = $this->getClientId()) {
            $data['clientId'] = $clientId;
        }

        if ($merchantLogin = $this->getMerchantLogin()) {
            $data['merchantLogin'] = $merchantLogin;
        }

        if ($jsonParams = $this->getJsonParams()) {
            $data['jsonParams'] = $jsonParams;
        }

        if ($sessionTimeoutSecs = $this->getSessionTimeoutSecs()) {
            $data['sessionTimeoutSecs'] = $sessionTimeoutSecs;
        }

        if ($expirationDate = $this->getExpirationDate()) {
            $data['expirationDate'] = $expirationDate;
        }

        if ($bindingId = $this->getBindingId()) {
            $data['bindingId'] = $bindingId;
        }

        return $data;
    }

    /**
     * @return mixed
     */
    public function getTransactionId()
    {
        return $this->getParameter('orderNumber');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setTransactionId($value)
    {
        return $this->setParameter('orderNumber', $value);
    }

    /**
     * @return mixed
     */
    public function getCancelUrl()
    {
        return $this->getParameter('failUrl');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setCancelUrl($value)
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
     * @return mixed
     */
    public function getPageView()
    {
        return $this->getParameter('pageView');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setPageView($value)
    {
        return $this->setParameter('pageView', $value);
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->getParameter('clientId');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setClientId($value)
    {
        return $this->setParameter('clientId', $value);
    }

    /**
     * @return mixed
     */
    public function getMerchantLogin()
    {
        return $this->getParameter('merchantLogin');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setMerchantLogin($value)
    {
        return $this->setParameter('merchantLogin', $value);
    }

    /**
     * @return mixed
     */
    public function getJsonParams()
    {
        return $this->getParameter('jsonParams');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setJsonParams($value)
    {
        return $this->setParameter('jsonParams', $value);
    }

    /**
     * @return mixed
     */
    public function getSessionTimeoutSecs()
    {
        return $this->getParameter('sessionTimeoutSecs');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setSessionTimeoutSecs($value)
    {
        return $this->setParameter('sessionTimeoutSecs', $value);
    }

    /**
     * @return mixed
     */
    public function getExpirationDate()
    {
        return $this->getParameter('expirationDate');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setExpirationDate($value)
    {
        return $this->setParameter('expirationDate', $value);
    }

    /**
     * @return mixed
     */
    public function getBindingId()
    {
        return $this->getParameter('bindingId');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setBindingId($value)
    {
        return $this->setParameter('bindingId', $value);
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