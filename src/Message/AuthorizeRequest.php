<?php

namespace Omnipay\Sberbank\Message;

class AuthorizeRequest extends PurchaseRequest
{
    /**
     * @return string
     */
    public function getMethod()
    {
        return 'registerPreAuth.do';
    }
}