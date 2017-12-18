<?php

namespace Omnipay\Sberbank\Message;

/**
 * Class PurchaseRequest
 * @package Omnipay\Sberbank\Message
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('mdOrder', 'bindingId', 'ip');

        $data = [
            'mdOrder' => $this->getMdorder(),
            'bindingId' => $this->getBindingId(),
            'ip' => $this->getIp()
        ];

        $additionalParams = ['language', 'cvc', 'email'];

        return $this->specifyAdditionalParameters($data, $additionalParams);
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'paymentOrderBinding.do';
    }

    /**
     * Set order number
     *
     * @param $mdorder
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setMdOrder($mdorder)
    {
        return $this->setParameter('mdOrder', $mdorder);
    }

    /**
     * Get order number in the payment system.
     *
     * Unique within the system.
     *
     * @return mixed
     */
    public function getMdOrder()
    {
        return $this->getParameter('mdOrder');
    }

    /**
     * Set identifier of the bundle created when the order was paid or used for payment.
     *
     * Is present only if the magazine is allowed to create bundles.
     *
     * @param $bindingId
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setBindingId($bindingId)
    {
        return $this->setParameter('bindingId', $bindingId);
    }

    /**
     * Get identifier of the bundle
     *
     * @return mixed
     */
    public function getBindingId()
    {
        return $this->getParameter('bindingId');
    }

    /**
     * Set client IP-address
     *
     * @param $ip
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setIp($ip)
    {
        return $this->setParameter('ip', $ip);
    }

    /**
     * Get client IP-address
     *
     * @return mixed
     */
    public function getIp()
    {
        return $this->getParameter('ip');
    }

    /**
     * Set CVC code.
     *
     * This parameter is required if the permission "Can carry out payment without CVC confirmation"
     * is not selected for the merchant.
     *
     * @param $cvc
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setCvc($cvc)
    {
        return $this->setParameter('cvc', $cvc);
    }

    /**
     * Get CVC code.
     *
     * @return mixed
     */
    public function getCvc()
    {
        return $this->getParameter('cvc');
    }

    /**
     * Set E-mail address of the payer.
     *
     * @param $email
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setEmail($email)
    {
        return $this->setParameter('email', $email);
    }

    /**
     * Set E-mail address of the payer.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->getParameter('email');
    }
}
