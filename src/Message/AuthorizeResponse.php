<?php

namespace Omnipay\Sberbank\Message;

class AuthorizeResponse extends PreAuthorizeResponse
{
    /**
     * @return bool
     */
    public function isRedirect()
    {
        return true;
    }
}
