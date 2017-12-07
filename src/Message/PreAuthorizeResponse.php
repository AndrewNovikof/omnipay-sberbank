<?php

namespace Omnipay\Sberbank\Message;

use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

class PreAuthorizeResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * The URL of the payment form to which the client's browser should be redirected.
     *
     * @var string
     */
    protected $formUrl;

    /**
     * The order number in the payment system. Unique within the system.
     *
     * @var string
     */
    protected $orderId;

    /**
     * PreAuthorizeResponse constructor.
     *
     * @param RequestInterface $request
     * @param $data
     */
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);
        array_key_exists('formUrl', $data) ? $this->formUrl = (string)$data['formUrl'] : $this->formUrl = null;
        array_key_exists('orderId', $data) ? $this->orderId = (string)$data['orderId'] : $this->orderId = null;
    }

	/**
	 * @return bool
	 */
    public function isRedirect()
    {
        return false;
    }

	/**
	 * @return string
	 */
    public function getRedirectUrl()
    {
        return $this->formUrl;
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
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }
}
