<?php

namespace Omnipay\Sberbank\Message;

/**
 * Class UpdateSSLCardListRequest
 * @package Omnipay\Sberbank\Message
 */
class UpdateSSLCardListRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('mdorder');

        $data = [
            'mdorder' => $this->getMdorder(),
        ];

        return $data;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'updateSSLCardList.do';
    }

    /**
     * Set order number
     *
     * @param $mdorder
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setMdorder($mdorder)
    {
        return $this->setParameter('mdorder', $mdorder);
    }

    /**
     * Get order number in the payment system.
     *
     * Unique within the system.
     *
     * @return mixed
     */
    public function getMdorder()
    {
        return $this->getParameter('mdorder');
    }
}
