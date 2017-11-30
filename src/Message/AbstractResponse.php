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
    public function __construct(RequestInterface $request, $data) {
        parent::__construct($request, $data);
        if ($data->errorCode != 0) {
            $this->code = ( string ) $this->data->errorCode;
            $this->data = ( string ) $this->data->errorMessage;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage() {
        if (!$this->isSuccessful()) {
            return $this->data;
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode() {
        if (!$this->isSuccessful()) {
            return $this->code;
        }
        return null;
    }
}