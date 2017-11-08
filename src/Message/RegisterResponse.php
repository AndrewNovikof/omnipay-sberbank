<?php

namespace Omnipay\Sberbank\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class RegisterResponse extends AbstractResponse implements RedirectResponseInterface
{
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
        return $this->data->formUrl != '';
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectUrl()
    {
        return (string) $this->data->formUrl;
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
    public function getRedirectData() {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getTransactionId()
    {
        return (string) $this->data->orderId;
    }
}
