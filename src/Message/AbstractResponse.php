<?php

namespace Omnipay\Sberbank\Message;

use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;
use Omnipay\Common\Message\RequestInterface;

abstract class AbstractResponse extends BaseAbstractResponse
{
    /**
     * @var string
     */
    protected $code;

    /**
     * {@inheritdoc}
     */
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);
        if ($data->errorCode) {
            $this->code = (string)$data->errorCode;
            $this->data = (string)$data->errorMessage;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return $this->isSuccessful() ? $this->data : null;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        return $this->isSuccessful() ? $this->code : null;
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->data;
    }
}