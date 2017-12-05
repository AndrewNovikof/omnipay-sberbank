<?php

namespace Omnipay\Sberbank\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
	/**
	 * @var string
	 */
    protected $endpoint;

	/**
	 * @return bool
	 */
    public function isSuccessful()
    {
        return false;
    }

	/**
	 * @return bool
	 */
    public function isRedirect()
    {
        return $this->isSuccessful();
    }

	/**
	 * @return string
	 */
    public function getRedirectUrl()
    {
        return $this->endpoint;
    }

	/**
	 * @return string
	 */
    public function getRedirectMethod()
    {
        return 'POST';
    }

	/**
	 * @return mixed
	 */
    public function getRedirectData()
    {
        return $this->data;
    }
}
