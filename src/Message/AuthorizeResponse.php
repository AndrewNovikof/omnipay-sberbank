<?php

namespace Omnipay\Sberbank\Message;

use Omnipay\Sberbank\Gateway;

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
