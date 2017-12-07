<?php

namespace Omnipay\Sberbank\Message;

class AuthorizeRequest extends PreAuthorizeRequest
{
    public function getMethod()
    {
        return 'register.do';
    }
}