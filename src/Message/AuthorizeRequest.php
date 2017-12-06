<?php

namespace Omnipay\Sberbank\Message;

class AuthorizeRequest extends PurchaseRequest
{
    protected function getMethod()
    {
        return 'register.do';
    }
}