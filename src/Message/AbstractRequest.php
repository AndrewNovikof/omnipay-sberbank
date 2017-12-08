<?php

namespace Omnipay\Sberbank\Message;

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
     * @param $data
     * @return mixed
     */
    public abstract function sendData($data);

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
}