<?php

namespace Omnipay\Sberbank\Message;

class AuthorizeRequest extends PurchaseRequest
{
    protected $endpoint =  '/registerPreAuth.do';
}