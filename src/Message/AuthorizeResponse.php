<?php

namespace Omnipay\Sberbank\Message;

class AuthorizeResponse extends PurchaseResponse
{
    /**
     * @return bool
     */
    public function isRedirect()
    {
        return true;
    }
}
