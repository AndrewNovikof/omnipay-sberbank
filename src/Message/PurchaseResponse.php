<?php

namespace Omnipay\Sberbank\Message;

use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

/**
 * Class PurchaseResponse
 * @package Omnipay\Sberbank\Message
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * @return bool
     */
    public function isRedirect()
    {
        return array_key_exists('redirect', $this->data) ? true : false;
    }

    /**
     * Get the URL of the payment form to which the client's browser should be redirected.
     *
     * @return mixed|null
     */
    public function getRedirectUrl()
    {
        return array_key_exists('redirect', $this->data) ? $this->data['redirect'] : null;
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
        return $this->data;
    }

    /**
     * If the response was successful in the case of an SSL payment.
     *
     * The URL to which the call is redirected after payment.
     *
     * @return mixed|null
     */
    public function getRedirect()
    {
        return array_key_exists('redirect', $this->data) ? $this->data['redirect'] : null;
    }

    /**
     * Order info message
     *
     * @return mixed|null
     */
    public function getInfo()
    {
        return array_key_exists('info', $this->data) ? $this->data['info'] : null;
    }

    /**
     * If response with an error. Error message.
     *
     * @return mixed|null
     */
    public function getError()
    {
        return array_key_exists('error', $this->data) ? $this->data['error'] : null;
    }

    /**
     * If response is successful in the case of 3DS-payment. URL to go to ACS.
     *
     * @return mixed|null
     */
    public function getAcsUrl()
    {
        return array_key_exists('acsUrl', $this->data) ? $this->data['acsUrl'] : null;
    }

    /**
     * If response is successful in the case of 3DS-payment. Payment Authentication Request.
     *
     * @return mixed|null
     */
    public function getPaReq()
    {
        return array_key_exists('paReq', $this->data) ? $this->data['paReq'] : null;
    }

    /**
     * If response is successful in the case of 3DS-payment. Return URL from ACS.
     *
     * @return mixed|null
     */
    public function getTermUrl()
    {
        return array_key_exists('termUrl', $this->data) ? $this->data['termUrl'] : null;
    }
}
