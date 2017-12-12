<?php

namespace Omnipay\Sberbank\Message;

class BindCardRequest extends UnBindCardRequest
{
    /**
     * @return string
     */
    public function getMethod()
    {
        return 'bindCard.do';
    }
}
