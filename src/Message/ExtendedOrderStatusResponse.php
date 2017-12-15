<?php

namespace Omnipay\Sberbank\Message;

/**
 * Class ExtendedOrderStatusResponse
 * @package Omnipay\Sberbank\Message
 */
class ExtendedOrderStatusResponse extends OrderStatusResponse
{
    /**
     * Response Message
     *
     * @return null|string A response message from the payment gateway
     */
    public function getMessage()
    {
        return array_key_exists('errorMessage', $this->data) ? $this->data['errorMessage'] : null;
    }

    /**
     * Response code
     *
     * @return null|string A response code from the payment gateway
     */
    public function getCode()
    {
        return array_key_exists('errorCode', $this->data) ? $this->data['errorCode'] : null;
    }

    /**
     * Number (identifier) of the order in the store system
     *
     * @return mixed|null
     */
    public function getOrderNumber()
    {
        return array_key_exists('orderNumber', $this->data) ? $this->data['orderNumber'] : null;
    }

    /**
     * Order status
     *
     * The value of this parameter determines the status of the order in the payment system.
     * Missing if the order was not found.
     *
     * @return mixed|null
     */
    public function getOrderStatus()
    {
        return array_key_exists('orderStatus', $this->data) ? $this->data['orderStatus'] : null;
    }

    /**
     * Response code
     *
     * @return mixed|null
     */
    public function getActionCode()
    {
        return array_key_exists('actionCode', $this->data) ? $this->data['actionCode'] : null;
    }

    /**
     * Decoding the response code in the language sent in the Language parameter in the query
     *
     * @return mixed|null
     */
    public function getActionCodeDescription()
    {
        return array_key_exists('actionCodeDescription', $this->data) ? $this->data['actionCodeDescription'] : null;
    }

    /**
     * Order registration date
     *
     * @return mixed|null
     */
    public function getDate()
    {
        return array_key_exists('date', $this->data) ? $this->data['date'] : null;
    }

    /**
     * Description of the order transferred at its registration
     *
     * @return mixed|null
     */
    public function getOrderDescription()
    {
        return array_key_exists('orderDescription', $this->data) ? $this->data['orderDescription'] : null;
    }

    /**
     * Order parameters.
     *
     * Is present in the response, if the order contains additional parameters of the seller.
     * Each additional order parameter is presented in a separate block.
     * The blocks of the merchantOrderParams element consist of the name and value fields:
     *
     * @return mixed|null
     */
    public function getMerchantOrderParams()
    {
        return array_key_exists('merchantOrderParams', $this->data) ? $this->data['merchantOrderParams'] : [];
    }

    /**
     * @return array
     */
    public function getCardAuthInfo()
    {
        return array_key_exists('cardAuthInfo', $this->data) ? $this->data['cardAuthInfo'] : [];
    }

    /**
     * {@inheritdoc}
     * @return mixed|null
     */
    public function getPan()
    {
        $cardAuthInfo = $this->getCardAuthInfo();
        return array_key_exists('pan', $cardAuthInfo) ? $cardAuthInfo['pan'] : null;
    }

    /**
     * {@inheritdoc}
     * @return mixed|null
     */
    public function getExpiration()
    {
        $cardAuthInfo = $this->getCardAuthInfo();
        return array_key_exists('expiration', $cardAuthInfo) ? $cardAuthInfo['expiration'] : null;
    }

    /**
     * {@inheritdoc}
     * @return mixed|null
     */
    public function getCardHolderName()
    {
        $cardAuthInfo = $this->getCardAuthInfo();
        return array_key_exists('cardholderName', $cardAuthInfo) ? $cardAuthInfo['cardholderName'] : null;
    }

    /**
     * {@inheritdoc}
     * @return mixed|null
     */
    public function getApprovalCode()
    {
        $cardAuthInfo = $this->getCardAuthInfo();
        return array_key_exists('approvalCode', $cardAuthInfo) ? $cardAuthInfo['approvalCode'] : null;
    }

    /**
     * @return array
     */
    public function getSecureAuthInfo()
    {
        $cardAuthInfo = $this->getCardAuthInfo();
        return array_key_exists('secureAuthInfo', $cardAuthInfo) ? $cardAuthInfo['secureAuthInfo'] : [];
    }

    /**
     * Electronic commercial indicator.
     *
     * It is indicated only after payment of the order and in case of the appropriate permit
     *
     * @return mixed|null
     */
    public function getEci()
    {
        $secureAuthInfo = $this->getSecureAuthInfo();
        return array_key_exists('eci', $secureAuthInfo) ? $secureAuthInfo['eci'] : null;
    }

    /**
     * The value of the cardholder authentication verification.
     *
     * It is indicated only after payment of the order and in case of the appropriate permit
     *
     * @return mixed|null
     */
    public function getCavv()
    {
        $secureAuthInfo = $this->getSecureAuthInfo();
        return array_key_exists('cavv', $secureAuthInfo) ? $secureAuthInfo['cavv'] : null;
    }

    /**
     * Electronic commercial transaction identifier.
     *
     * It is indicated only after payment of the order and in case of the appropriate permit
     *
     * @return mixed|null
     */
    public function getXid()
    {
        $secureAuthInfo = $this->getSecureAuthInfo();
        return array_key_exists('xid', $secureAuthInfo) ? $secureAuthInfo['xid'] : null;
    }

    /******************************************************************************************************************
     * Response parameters for versions 02, 03:
     * If the client specifies the version getOrderStatusExtended 02 and higher,
     * then the following parameters will also be returned in the response,
     * in addition to the parameters described above.
     ******************************************************************************************************************/

    /**
     * Authorization date / time
     *
     * @return mixed|null
     */
    public function getAuthDateTime()
    {
        return array_key_exists('authDateTime', $this->data) ? $this->data['authDateTime'] : null;
    }

    /**
     * Reference number
     *
     * @return mixed|null
     */
    public function getAuthRefNum()
    {
        return array_key_exists('authRefNum', $this->data) ? $this->data['authRefNum'] : null;
    }

    /**
     * @return null
     */
    public function getTerminalId()
    {
        return array_key_exists('terminalId', $this->data) ? $this->data['terminalId'] : null;
    }

    /******************************************************************************************************************
     * Response parameters for version 03:
     * If the client specifies the version getOrderStatusExtended 03,
     * then the following parameters will also be returned in the response,
     * in addition to the parameters described above.
     ******************************************************************************************************************/

    /**
     * @return array
     */
    public function getPaymentAmountInfo()
    {
        return array_key_exists('paymentAmountInfo', $this->data) ? $this->data['paymentAmountInfo'] : [];
    }

    /**
     * Amount, postulated on the card (used only for two-stage payments)
     *
     * @return mixed|null
     */
    public function getApprovedAmount()
    {
        $paymentAmountInfo = $this->getPaymentAmountInfo();
        return array_key_exists('approvedAmount', $paymentAmountInfo) ? $paymentAmountInfo['approvedAmount'] : null;
    }

    /**
     * Amount confirmed for debit from card
     *
     * @return mixed|null
     */
    public function getDepositedAmount()
    {
        $paymentAmountInfo = $this->getPaymentAmountInfo();
        return array_key_exists('depositedAmount', $paymentAmountInfo) ? $paymentAmountInfo['depositedAmount'] : null;
    }

    /**
     * Refunded amount
     *
     * @return mixed|null
     */
    public function getRefundedAmount()
    {
        $paymentAmountInfo = $this->getPaymentAmountInfo();
        return array_key_exists('refundedAmount', $paymentAmountInfo) ? $paymentAmountInfo['refundedAmount'] : null;
    }

    /**
     * Order status
     *
     * @return mixed|null
     */
    public function getPaymentState()
    {
        $paymentAmountInfo = $this->getPaymentAmountInfo();
        return array_key_exists('paymentState', $paymentAmountInfo) ? $paymentAmountInfo['paymentState'] : null;
    }

    /**
     * @return array
     */
    public function getBankInfo()
    {
        return array_key_exists('bankInfo', $this->data) ? $this->data['bankInfo'] : [];
    }

    /**
     * Name of the issuing bank
     *
     * @return mixed|null
     */
    public function getBankName()
    {
        $bankInfo = $this->getBankInfo();
        return array_key_exists('bankName', $bankInfo) ? $bankInfo['bankName'] : null;
    }

    /**
     * Country code of the issuing bank
     *
     * @return mixed|null
     */
    public function getBankCountryCode()
    {
        $bankInfo = $this->getBankInfo();
        return array_key_exists('bankCountryCode', $bankInfo) ? $bankInfo['bankCountryCode'] : null;
    }

    /**
     * Name of the country of the issuing bank in the language transmitted in the language parameter in the request,
     * or in the language of the user who called the method, if the language in the request is not specified
     *
     * @return mixed|null
     */
    public function getBankCountryName()
    {
        $bankInfo = $this->getBankInfo();
        return array_key_exists('bankCountryName', $bankInfo) ? $bankInfo['bankCountryName'] : null;
    }
}
