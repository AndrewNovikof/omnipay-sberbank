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
        array_key_exists('errorCode', $data) ? $this->errorCode = (string)$data['errorCode'] : $this->errorCode = null;
        array_key_exists('errorMessage', $data) ? $this->errorMessage = (string)$data['errorMessage'] : $this->errorMessage = null;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return $this->errorMessage;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        return $this->errorCode;
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return (int) $this->errorCode === 0;
    }
}