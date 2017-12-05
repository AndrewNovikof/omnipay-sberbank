<?php

namespace Omnipay\Sberbank;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Sberbank\Message\AuthorizeRequest;

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
            'testMode' => false
        ];
    }

    /**Start an authorize request
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
        return $this->createRequest(AuthorizeRequest::class, $options);
    }

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
