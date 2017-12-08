<?php

namespace Omnipay\Sberbank\Message;

use Omnipay\Common\Exception\RuntimeException;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

abstract class AbstractRequest extends BaseAbstractRequest
{
    /**
     * Method name from bank API
     *
     * @return string
     */
    abstract protected function getMethod();

    /**
     * Get endpoint URL
     *
     * @return string
     */
    public function getEndPoint()
    {
        return $this->getParameter('endPoint');
    }

    /**
     * Set endpoint URL
     *
     * @param string $endPoint
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setEndPoint($endPoint)
    {
        return $this->setParameter('endPoint', $endPoint);
    }

    /**
     * Set gateway password of merchant account
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * Set gateway password of merchant account
     *
     * @param $password
     * @return BaseAbstractRequest
     */
    public function setPassword($password)
    {
        return $this->setParameter('password', $password);
    }

    /**
     * Get gateway password of merchant
     *
     * @return mixed
     */
    public function getUserName()
    {
        return $this->getParameter('userName');
    }

    /**
     * Set gateway userName of merchant
     *
     * @param $value
     * @return BaseAbstractRequest
     */
    public function setUserName($value)
    {
        return $this->setParameter('userName', $value);
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
     * Get Request headers
     *
     * @return array
     */
    public function getHeaders()
    {
        return [];
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return 'POST';
    }

    /**
     * Sberbank acquiring request the currency in the minimal payment units
     *
     * @return int
     */
    public function getCurrencyDecimalPlaces()
    {
        return 0;
    }

    /**
     * @param mixed $data
     * @return object|\Omnipay\Common\Message\ResponseInterface
     */
    public function sendData($data)
    {
        $url = $this->getEndPoint() . $this->getMethod();
        $httpRequest = $this->httpClient->createRequest(
            $this->getHttpMethod(),
            $url,
            $this->getHeaders(),
            $data
        );
        $httpResponse = $httpRequest->send();

        $responseClassName = preg_replace('/Request/', 'Response', get_class($this));
        $reflection = new \ReflectionClass($responseClassName);
        if(!$reflection->isInstantiable()){
            throw new RuntimeException('Class '.preg_replace('/Request/', 'Response', get_class($this)).' not found');
        }

        return $reflection->newInstance($this, json_decode($httpResponse->getBody(true), true));
    }
}