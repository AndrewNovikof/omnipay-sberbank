<?php

namespace Omnipay\Sberbank\Message;

use Fiscal\OFD\OrderInterface;
use Fiscal\OFD\OrderItemInterface;
use Omnipay\Sberbank\Util\FiscalOFDAdapter;

/**
 * Class CaptureRequest
 *
 * @package Omnipay\Sberbank\Message
 */
class CaptureRequest extends AbstractRequest
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
            'depositItems',
        ];

        return $this->specifyAdditionalJsonParameters($data, $additionalJsonParams);
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'deposit.do';
    }

    /**
     * @return array|null
     */
    public function getDepositItems()
    {
        return $this->getParameter('depositItems');
    }

    /**
     * @param OrderInterface|array|null $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     * @throws \Omnipay\Common\Exception\RuntimeException
     */
    public function setDepositItems($value)
    {
        if(interface_exists('Fiscal\\OFD\\OrderInterface') && $value instanceof OrderInterface) {
            $adapter = new FiscalOFDAdapter($value);
            $value = $adapter->getDepositItems();
        }
        return $this->setParameter('depositItems', $value);
    }
}
