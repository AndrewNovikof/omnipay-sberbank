<?php

namespace Omnipay\Sberbank\Message;

use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;
use Omnipay\Common\Message\RequestInterface;

abstract class AbstractResponse extends BaseAbstractResponse
{
    /**
     * @var string
     */
    protected $errorCode;

    /**
     * @var
     */
    protected $errorMessage;

    /**
     * {@inheritdoc}
     */
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);
        $data->errorCode ? $this->errorCode = (string)$data->errorCode : $this->errorCode = null;
        $data->errorMessage ? $this->errorMessage = (string)$data->errorMessage : $this->errorMessage = null;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return $this->isSuccessful() ? $this->errorMessage : null;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        return $this->isSuccessful() ? $this->errorCode : null;
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->errorCode === 0;
    }
}