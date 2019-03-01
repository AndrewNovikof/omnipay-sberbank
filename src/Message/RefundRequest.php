<?php

namespace Omnipay\Sberbank\Message;

use Fiscal\OFD\OrderInterface;
use Fiscal\OFD\OrderItemInterface;
use Omnipay\Sberbank\Util\FiscalOFDAdapter;

/**
 * Class RefundRequest
 *
 * @package Omnipay\Sberbank\Message
 */
class RefundRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('orderId', 'amount');

        $data = [
            'orderId' => $this->getOrderId(),
            'amount' => $this->getAmountInteger(),
        ];

        $additionalJsonParams = [
            'refundItems',
        ];

        return $this->specifyAdditionalJsonParameters($data, $additionalJsonParams);
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'refund.do';
    }

    /**
     * @return mixed
     */
    public function getRefundItems()
    {
        return $this->getParameter('refundItems');
    }

    /**
     * @param OrderInterface|array $value
     * @return \Omnipay\Common\Message\AbstractRequest
     * @throws \Omnipay\Common\Exception\RuntimeException
     */
    public function setRefundItems($value)
    {
        if(interface_exists('Fiscal\\OFD\\OrderInterface') && $value instanceof OrderInterface) {
            $adapter = new FiscalOFDAdapter($value);
            $value = $adapter->getRefundItems();
        }
        return $this->setParameter('refundItems', $value);
    }
}
