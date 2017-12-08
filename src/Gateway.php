<?php

namespace Omnipay\Sberbank;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Sberbank\Message\AuthorizeRequest;
use Omnipay\Sberbank\Message\PurchaseRequest;

/**
 * Class Gateway
 * @package Omnipay\Sberbank
 */
class Gateway extends AbstractGateway
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Sberbank';
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultParameters()
    {
        return [
            'userName' => '',
            'password' => '',
            'testMode' => false,
            'endPoint' => 'https://securepayments.sberbank.ru/payment/rest/'
        ];
    }

    /**
     * Set gateway test mode. Also changes URL
     *
     * @param bool $testMode
     * @return $this
     */
    public function setTestMode($testMode)
    {
        $this->setEndPoint($testMode ? 'https://3dsec.sberbank.ru/payment/rest/' : 'https://securepayments.sberbank.ru/payment/rest/');

        return $this->setParameter('testMode', $testMode);
    }

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
     * @return $this
     */
    public function setEndPoint($endPoint)
    {
        return $this->setParameter('endPoint', $endPoint);
    }

    /**
     * Get gateway user name
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->getParameter('userName');
    }

    /**
     * Set gateway user name
     *
     * @param string $userName
     * @return $this
     */
    public function setUserName($userName)
    {
        return $this->setParameter('userName', $userName);
    }

    /**
     * Get gateway password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * Set gateway password
     *
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        return $this->setParameter('password', $password);
    }

    /**
     * Start an authorize request
     *
     * @param array $options array of options
     * @return RequestInterface
     */
    public function authorize(array $options = []): RequestInterface
    {
        return $this->createRequest(AuthorizeRequest::class, $options);
    }

    /**
     * Start a purchase request
     *
     * @param array $options array of options
     * @return RequestInterface
     */
    public function purchase(array $options = []): RequestInterface
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     * Start complete Authorize request
     *
     * @param array $options
     * @return RequestInterface
     */
    function completeAuthorize(array $options = []): RequestInterface
    {
        // TODO: Implement completeAuthorize() method.
    }

    function refund(array $options = []): RequestInterface
    {
        // TODO: Implement refund() method.
    }

    function deleteCard(array $options = []): RequestInterface
    {
        // TODO: Implement deleteCard() method.
    }

    function completePurchase(array $options = []): RequestInterface
    {
        // TODO: Implement completePurchase() method.
    }

    function void(array $options = []): RequestInterface
    {
        // TODO: Implement void() method.
    }

    function capture(array $options = []): RequestInterface
    {
        // TODO: Implement capture() method.
    }

    function createCard(array $options = []): RequestInterface
    {
        // TODO: Implement createCard() method.
    }

    function updateCard(array $options = []): RequestInterface
    {
        // TODO: Implement updateCard() method.
    }
}
