<?php

namespace Omnipay\Sberbank\Message;

/**
 * Class GetBindingsRequest
 * @package Omnipay\Sberbank\Message
 */
class GetBindingsRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('clientId');

        $data = [
            'clientId' => $this->getClientId()
        ];

        return $data;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'getBindings.do';
    }

    /**
     * Get number (identifier) of the customer in the store system, transferred at the time of order registration.
     *
     * @return mixed
     */
    public function getClientId()
    {
        return $this->getParameter('clientId');
    }

    /**
     * Set number (identifier) of the customer in the store system, transferred at the time of order registration.
     *
     * Is present only if the magazine is allowed to create bundles.
     *
     * @param $clientId
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setClientId($clientId)
    {
        return $this->setParameter('clientId', $clientId);
    }
}
