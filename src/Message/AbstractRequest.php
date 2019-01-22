<?php

namespace Omnipay\Sberbank\Message;

use Omnipay\Common\Exception\RuntimeException;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

/**
 * Class AbstractRequest
 * @package Omnipay\Sberbank\Message
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    /**
     * Method name from bank API
     *
     * @return string
     */
    abstract public function getMethod();

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
    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setOrderId($value)
    {
        return $this->setParameter('orderId', $value);
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
        return [
            "content-type" => 'application/x-www-form-urlencoded'
        ];
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
     * @throws \ReflectionException
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function sendData($data)
    {
        $url = $this->getEndPoint() . $this->getMethod();
        $this->validate('userName', 'password');
        $data = array_merge(
            [
                'userName' => $this->getUserName(),
                'password' => $this->getPassword(),
            ],
            $data
        );

        $httpResponse = $this->httpClient->request(
            $this->getHttpMethod(),
            $url,
            $this->getHeaders(),
            http_build_query($data, '', '&')
        );

        $responseClassName = str_replace('Request', 'Response', \get_class($this));
        $reflection = new \ReflectionClass($responseClassName);
        if (!$reflection->isInstantiable()) {
            throw new RuntimeException(
                'Class ' . str_replace('Request', 'Response', \get_class($this)) . ' not found'
            );
        }

        $content = json_decode($httpResponse->getBody()->getContents(), true);

        return $reflection->newInstance($this, $content);
    }

    /**
     * Add additional params to data
     *
     * @param array $data
     * @param array $additionalParams
     * @return array
     */
    public function specifyAdditionalParameters(array $data, array $additionalParams): array
    {
        foreach ($additionalParams as $param) {
            $method = 'get' . ucfirst($param);
            if (method_exists($this, $method)) {
                $value = $this->{$method}();
                if ($value) {
                    $data[$param] = $value;
                }
            }
        }
        return $data;
    }
}
