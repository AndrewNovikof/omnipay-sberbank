<?php

namespace Omnipay\Sberbank\Message;

use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

class AuthorizeResponse extends AbstractResponse implements RedirectResponseInterface
{

    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);
        if ($data->errorCode != 0) {
            $this->code = ( string ) $this->data->errorCode;
            $this->data = ( string ) $this->data->errorMessage;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function isRedirect()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectUrl()
    {
        return (string)$this->data->formUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectMethod()
    {
        return 'GET';

    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectData()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getTransactionId()
    {
        return (string)$this->data->orderId;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return $this->data->errorMessage;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        return $this->data->errorCode;
    }
}
