<?php

namespace Omnipay\Sberbank\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Class AuthorizeResponse
 * @package Omnipay\Sberbank\Message
 */
class AuthorizeResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * @return bool
     */
    public function isRedirect()
    {
        return array_key_exists('formUrl', $this->data) ? true : false;
    }

    /**
     * Get the URL of the payment form to which the client's browser should be redirected.
     *
     * @return mixed|null
     */
    public function getRedirectUrl()
    {
        return array_key_exists('formUrl', $this->data) ? $this->data['formUrl'] : null;
    }

    /**
     * Get the order number in the payment system. Unique within the system.
     *
     * @return mixed|null
     */
    public function getOrderId()
    {
        return array_key_exists('orderId', $this->data) ? $this->data['orderId'] : null;
    }

    /**
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * @return mixed
     */
    public function getRedirectData()
    {
        return [];
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return !array_key_exists('errorCode', $this->data);
    }
}
