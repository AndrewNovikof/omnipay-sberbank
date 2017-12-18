<?php

namespace Omnipay\Sberbank\Message;

/**
 * Class GetLastOrdersForMerchantsResponse
 * @package Omnipay\Sberbank\Message
 */
class GetLastOrdersForMerchantsResponse extends AbstractResponse
{
    /**
     * Total number of items in the report (on all pages).
     *
     * @return mixed|null
     */
    public function getTotalCount()
    {
        return array_key_exists('totalCount', $this->data) ? $this->data['totalCount'] : null;
    }

    /**
     * The number of the current page (equal to the page number sent in the request).
     *
     * @return mixed|null
     */
    public function getPage()
    {
        return array_key_exists('page', $this->data) ? $this->data['page'] : null;
    }

    /**
     * Maximum number of entries per page (equal to the size of the page sent in the request)
     *
     * @return mixed|null
     */
    public function getPageSize()
    {
        return array_key_exists('pageSize', $this->data) ? $this->data['pageSize'] : null;
    }

    /**
     * @return array
     */
    public function getOrderStatuses()
    {
        return array_key_exists('orderStatuses', $this->data) ? $this->data['orderStatuses'] : [];
    }

    /**
     * Number (identifier) of the order in the store system.
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getOrderNumber($orderIndex = 0)
    {
        $orderStatuses = $this->getOrderStatuses();
        return array_key_exists('orderNumber', $orderStatuses[$orderIndex])
            ? $orderStatuses[$orderIndex]['orderNumber'] : null;
    }

    /**
     * The status of the order in the payment system.
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getOrderStatus($orderIndex = 0)
    {
        $orderStatuses = $this->getOrderStatuses();
        return array_key_exists('orderStatus', $orderStatuses[$orderIndex])
            ? $orderStatuses[$orderIndex]['orderStatus'] : null;
    }

    /**
     * Response code
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getActionCode($orderIndex = 0)
    {
        $orderStatuses = $this->getOrderStatuses();
        return array_key_exists('actionCode', $orderStatuses[$orderIndex])
            ? $orderStatuses[$orderIndex]['actionCode'] : null;
    }

    /**
     * Response code description
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getActionCodeDescription($orderIndex = 0)
    {
        $orderStatuses = $this->getOrderStatuses();
        return array_key_exists('actionCodeDescription', $orderStatuses[$orderIndex])
            ? $orderStatuses[$orderIndex]['actionCodeDescription'] : null;
    }

    /**
     * The amount of payment in the minimum units of currency.
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getAmount($orderIndex = 0)
    {
        $orderStatuses = $this->getOrderStatuses();
        return array_key_exists('amount', $orderStatuses[$orderIndex]) ? $orderStatuses[$orderIndex]['amount'] : null;
    }

    /**
     * The currency code of the payment is ISO 4217.
     *
     * If not specified, it is considered equal to the default currency code.
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getCurrency($orderIndex = 0)
    {
        $orderStatuses = $this->getOrderStatuses();
        return array_key_exists('currency', $orderStatuses[$orderIndex])
            ? $orderStatuses[$orderIndex]['currency'] : null;
    }

    /**
     * Date of order registration.
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getDate($orderIndex = 0)
    {
        $orderStatuses = $this->getOrderStatuses();
        return array_key_exists('date', $orderStatuses[$orderIndex]) ? $orderStatuses[$orderIndex]['date'] : null;
    }

    /**
     * Description of the order transferred at its registration
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getOrderDescription($orderIndex = 0)
    {
        $orderStatuses = $this->getOrderStatuses();
        return array_key_exists('orderDescription', $orderStatuses[$orderIndex])
            ? $orderStatuses[$orderIndex]['orderDescription'] : null;
    }

    /**
     * Error code
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getOrderErrorCode($orderIndex = 0)
    {
        $orderStatuses = $this->getOrderStatuses();
        return array_key_exists('errorCode', $orderStatuses[$orderIndex])
            ? $orderStatuses[$orderIndex]['errorCode'] : null;
    }

    /**
     * IP address of the buyer.
     *
     * Specified only after payment.
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getIp($orderIndex = 0)
    {
        $orderStatuses = $this->getOrderStatuses();
        return array_key_exists('ip', $orderStatuses[$orderIndex]) ? $orderStatuses[$orderIndex]['ip'] : null;
    }

    /**
     * Authorization date / time
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getAuthDateTime($orderIndex = 0)
    {
        $orderStatuses = $this->getOrderStatuses();
        return array_key_exists('authDateTime', $orderStatuses[$orderIndex])
            ? $orderStatuses[$orderIndex]['authDateTime'] : null;
    }

    /**
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getTerminalId($orderIndex = 0)
    {
        $orderStatuses = $this->getOrderStatuses();
        return array_key_exists('terminalId', $orderStatuses[$orderIndex])
            ? $orderStatuses[$orderIndex]['terminalId'] : null;
    }

    /**
     * Reference number
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getAuthRefNum($orderIndex = 0)
    {
        $orderStatuses = $this->getOrderStatuses();
        return array_key_exists('authRefNum', $orderStatuses[$orderIndex])
            ? $orderStatuses[$orderIndex]['authRefNum'] : null;
    }

    /**
     * Tag with attributes in which additional parameters of the merchant are transferred
     *
     * @param int $orderIndex
     * @return array
     */
    public function getMerchantOrderParams($orderIndex = 0)
    {
        $orderStatuses = $this->getOrderStatuses();
        return array_key_exists('merchantOrderParams', $orderStatuses[$orderIndex])
            ? $orderStatuses[$orderIndex]['merchantOrderParams'] : [];
    }

    /**
     * Name of additional merchant parameter
     *
     * @param int $orderIndex
     * @param int $paramIndex
     * @return mixed|null
     */
    public function getMerchantOrderParamName($orderIndex = 0, $paramIndex = 0)
    {
        $orderParam = $this->getMerchantOrderParams($orderIndex);
        return array_key_exists('name', $orderParam[$paramIndex]) ? $orderParam[$paramIndex]['name'] : null;
    }

    /**
     * Value of additional merchant parameter
     *
     * @param int $orderIndex
     * @param int $paramIndex
     * @return mixed|null
     */
    public function getMerchantOrderParamValue($orderIndex = 0, $paramIndex = 0)
    {
        $orderParam = $this->getMerchantOrderParams($orderIndex);
        return array_key_exists('value', $orderParam[$paramIndex]) ? $orderParam[$paramIndex]['value'] : null;
    }

    /**
     * Order attributes in the payment system (order number).
     *
     * @param int $orderIndex
     * @return array
     */
    public function getBindingInfo($orderIndex = 0)
    {
        $orderStatuses = $this->getOrderStatuses();
        return array_key_exists('bindingInfo', $orderStatuses[$orderIndex])
            ? $orderStatuses[$orderIndex]['bindingInfo'] : [];
    }

    /**
     * Customer number (identifier) in the store system.
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getClientId($orderIndex = 0)
    {
        $bindingInfo = $this->getBindingInfo($orderIndex);
        return array_key_exists('clientId', $bindingInfo) ? $bindingInfo['clientId'] : null;
    }

    /**
     * The identifier of the bundle used for payment.
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getBindingId($orderIndex = 0)
    {
        $bindingInfo = $this->getBindingInfo($orderIndex);
        return array_key_exists('bindingId', $bindingInfo) ? $bindingInfo['bindingId'] : null;
    }

    /**
     * Order attributes in the payment system (order number).
     *
     * @param int $orderIndex
     * @return array
     */
    public function getAttributes($orderIndex = 0)
    {
        $orderStatuses = $this->getOrderStatuses();
        return array_key_exists('attributes', $orderStatuses[$orderIndex])
            ? $orderStatuses[$orderIndex]['attributes'] : [];
    }

    /**
     * Name of attribute
     *
     * @param int $orderIndex
     * @param int $attributeIndex
     * @return mixed|null
     */
    public function getAttributesName($orderIndex = 0, $attributeIndex = 0)
    {
        $attributes = $this->getAttributes($orderIndex);
        return array_key_exists('name', $attributes[$attributeIndex]) ? $attributes[$attributeIndex]['name'] : null;
    }

    /**
     * Value of attribute
     *
     * @param int $orderIndex
     * @param int $attributeIndex
     * @return mixed|null
     */
    public function getAttributesValue($orderIndex = 0, $attributeIndex = 0)
    {
        $attributes = $this->getAttributes($orderIndex);
        return array_key_exists('value', $attributes[$attributeIndex]) ? $attributes[$attributeIndex]['value'] : null;
    }

    /**
     * Payment attributes
     *
     * @param int $orderIndex
     * @return array
     */
    public function getCardAuthInfo($orderIndex = 0)
    {
        $orderStatuses = $this->getOrderStatuses();
        return array_key_exists('cardAuthInfo', $orderStatuses[$orderIndex])
            ? $orderStatuses[$orderIndex]['cardAuthInfo'] : [];
    }

    /**
     * Masked card number that was used for payment.
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getPan($orderIndex = 0)
    {
        $cardAuthInfo = $this->getCardAuthInfo($orderIndex);
        return array_key_exists('pan', $cardAuthInfo) ? $cardAuthInfo['pan'] : null;
    }

    /**
     * The expiration date of the card in the format YYYYMM.
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getExpiration($orderIndex = 0)
    {
        $cardAuthInfo = $this->getCardAuthInfo($orderIndex);
        return array_key_exists('expiration', $cardAuthInfo) ? $cardAuthInfo['expiration'] : null;
    }

    /**
     * Name of the card holder.
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getCardholderName($orderIndex = 0)
    {
        $cardAuthInfo = $this->getCardAuthInfo($orderIndex);
        return array_key_exists('cardholderName', $cardAuthInfo) ? $cardAuthInfo['cardholderName'] : null;
    }

    /**
     * The authorization code of the payment.
     *
     * A fixed-length field (6 characters), can contain numbers and Latin letters.
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getApprovalCode($orderIndex = 0)
    {
        $cardAuthInfo = $this->getCardAuthInfo($orderIndex);
        return array_key_exists('approvalCode', $cardAuthInfo) ? $cardAuthInfo['approvalCode'] : null;
    }

    /**
     * Information about the amounts of confirmation, cancellation, refund.
     *
     * @param int $index
     * @return array
     */
    public function getPaymentAmountInfo($index = 0)
    {
        $orderStatuses = $this->getOrderStatuses();
        return array_key_exists('paymentAmountInfo', $orderStatuses[$index])
            ? $orderStatuses[$index]['paymentAmountInfo'] : [];
    }

    /**
     * State of payment
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getPaymentState($orderIndex = 0)
    {
        $paymentAmountInfo = $this->getPaymentAmountInfo($orderIndex);
        return array_key_exists('paymentState', $paymentAmountInfo) ? $paymentAmountInfo['paymentState'] : null;
    }

    /**
     * Amount confirmed for cancellation.
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getApprovedAmount($orderIndex = 0)
    {
        $paymentAmountInfo = $this->getPaymentAmountInfo($orderIndex);
        return array_key_exists('approvedAmount', $paymentAmountInfo) ? $paymentAmountInfo['approvedAmount'] : null;
    }

    /**
     * The amount charged from the card.
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getDepositedAmount($orderIndex = 0)
    {
        $paymentAmountInfo = $this->getPaymentAmountInfo($orderIndex);
        return array_key_exists('depositedAmount', $paymentAmountInfo) ? $paymentAmountInfo['depositedAmount'] : null;
    }

    /**
     * Refund amount.
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getRefundedAmount($orderIndex = 0)
    {
        $paymentAmountInfo = $this->getPaymentAmountInfo($orderIndex);
        return array_key_exists('refundedAmount', $paymentAmountInfo) ? $paymentAmountInfo['refundedAmount'] : null;
    }

    /**
     * Information about the Issuing Bank.
     *
     * @param int $index
     * @return array
     */
    public function getBankInfo($index = 0)
    {
        $orderStatuses = $this->getOrderStatuses();
        return array_key_exists('bankInfo', $orderStatuses[$index]) ? $orderStatuses[$index]['bankInfo'] : [];
    }

    /**
     * Name of the issuing bank.
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getBankName($orderIndex = 0)
    {
        $bankInfo = $this->getBankInfo($orderIndex);
        return array_key_exists('bankName', $bankInfo) ? $bankInfo['bankName'] : null;
    }

    /**
     * Country code of the Issuing Bank.
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getBankCountryCode($orderIndex = 0)
    {
        $bankInfo = $this->getBankInfo($orderIndex);
        return array_key_exists('bankCountryCode', $bankInfo) ? $bankInfo['bankCountryCode'] : null;
    }

    /**
     * Country name of the Issuing Bank.
     *
     * @param int $orderIndex
     * @return mixed|null
     */
    public function getBankCountryName($orderIndex = 0)
    {
        $bankInfo = $this->getBankInfo($orderIndex);
        return array_key_exists('bankCountryName', $bankInfo) ? $bankInfo['bankCountryName'] : null;
    }
}
