<?php

namespace Omnipay\Sberbank\Message;

class AuthorizeRequest extends PurchaseRequest
{
    public function getMethod()
    {
        return 'register.do';
    }
}