<?php

namespace Omnipay\Sberbank\Message;

/**
 * Class OrderStatusResponse
 * @package Omnipay\Sberbank\Message
 */
class OrderStatusResponse extends AbstractResponse
{
    /**
     * Response Message
     *
     * @return null|string A response message from the payment gateway
     */
    public function getMessage()
    {
        return array_key_exists('ErrorMessage', $this->data) ? $this->data['ErrorMessage'] : null;
    }

    /**
     * Response code
     *
     * @return null|string A response code from the payment gateway
     */
    public function getCode()
    {
        return array_key_exists('ErrorCode', $this->data) ? $this->data['ErrorCode'] : null;
    }

    /**
     * Order status
     *
     * The value of this parameter determines the status of the order in the payment system.
     * Missing if the order was not found.
     *
     * @return int
     */
    public function getOrderStatus()
    {
        return array_key_exists('OrderStatus', $this->data) ? $this->data['OrderStatus'] : null;
    }

    /**
     * Number (identifier) of the order in the store system
     *
     * @return mixed
     */
    public function getOrderNumber()
    {
        return array_key_exists('OrderNumber', $this->data) ? $this->data['OrderNumber'] : null;
    }

    /**
     * Masked card number that was used for payment. Specified only after payment of the order.
     *
     * @return string
     */
    public function getPan()
    {
        return array_key_exists('Pan', $this->data) ? $this->data['Pan'] : null;
    }
    /**
     * The expiration date of the card in the format YYYYMM. Specified only after payment of the order.
     *
     * @return string
     */
    public function getExpiration()
    {
        return array_key_exists('expiration', $this->data) ? $this->data['expiration'] : null;
    }

    /**
     * Name of the card holder. Specified only after payment of the order.
     *
     * @return string
     */
    public function getCardHolderName()
    {
        return array_key_exists('cardholderName', $this->data) ? $this->data['cardholderName'] : null;
    }

    /**
     * The amount of payment in kopecks (or cents)
     *
     * @return int
     */
    public function getAmount()
    {
        return array_key_exists('Amount', $this->data) ? $this->data['Amount'] : null;
    }

    /**
     * Get deposited amount
     *
     * @return string
     */
    public function getDepositAmount()
    {
        return array_key_exists('depositAmount', $this->data) ? $this->data['depositAmount'] : null;
    }

    /**
     * The currency code of the payment is ISO 4217.
     *
     * If not specified, it is considered equal to the default currency code.
     *
     * @return int
     */
    public function getCurrency()
    {
        return array_key_exists('currency', $this->data) ? $this->data['currency'] : null;
    }

    /**
     * Authorization code of the IPU. A fixed-length field (6 characters), can contain numbers and Latin letters.
     *
     * @return string
     */
    public function getApprovalCode()
    {
        return array_key_exists('approvalCode', $this->data) ? $this->data['approvalCode'] : null;
    }

    /**
     * IP address of the user who paid for the order
     *
     * @return string
     */
    public function getIp()
    {
        return array_key_exists('Ip', $this->data) ? $this->data['Ip'] : null;
    }

    /**
     * @return array
     */
    public function getBindingInfo()
    {
        return array_key_exists('BindingInfo', $this->data) ? $this->data['BindingInfo'] : [];
    }

    /**
     * Number (identifier) of the customer in the store system, transferred at the time of order registration.
     *
     * Is present only if the magazine is allowed to create bundles.
     *
     * @return string
     */
    public function getClientId()
    {
        $bindingInfo = $this->getBindingInfo();
        return array_key_exists('clientId', $bindingInfo) ? $bindingInfo['clientId'] : null;
    }

    /**
     * The identifier of the bundle created when the order was paid or used for payment.
     *
     * Is present only if the magazine is allowed to create bundles.
     *
     * @return string
     */
    public function getBindingId()
    {
        $bindingInfo = $this->getBindingInfo();
        return array_key_exists('bindingId', $bindingInfo) ? $bindingInfo['bindingId'] : null;
    }
}
