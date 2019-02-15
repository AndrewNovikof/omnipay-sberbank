<?php

namespace Omnipay\Sberbank\Message;


class OrderReceiptStatusResponse extends AbstractResponse
{
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
     * Get the order number in the payment system. Unique within the system.
     *
     * @return string|null
     */
    public function getOrderId()
    {
        return array_key_exists('orderId', $this->data) ? $this->data['orderId'] : null;
    }

    /**
     * Server name
     *
     * @return string|null
     */
    public function getDaemonCode()
    {
        return array_key_exists('daemonСode', $this->data) ? $this->data['daemonСode'] : null;
    }

    /**
     * Checkout equipment code
     *
     * @return string|null
     */
    public function getDeviceCode()
    {
        return array_key_exists('deviceCode', $this->data) ? $this->data['deviceCode'] : null;
    }

    /**
     * Receipts list
     *
     * @return array
     */
    public function getReceipts()
    {
        return array_key_exists('receipt', $this->data) ? $this->data['receipt'] : [];
    }

    /**
     * Receipt
     *
     * @param int $index
     *
     * @return array
     */
    public function getReceipt($index)
    {
        $receiptList = $this->getReceipts();
        return array_key_exists('receipt', $receiptList[$index]) ? $receiptList[$index] : [];
    }

    /**
     * Receipt status
     *
     * @param int $index
     *
     * @return int|null
     */
    public function getReceiptStatus($index)
    {
        $receipt = $this->getReceipt($index);
        return array_key_exists('receiptStatus', $receipt) ? $receipt['receiptStatus'] : null;
    }

    /**
     * Receipt ID in the fiscalizer
     *
     * @param int $index
     *
     * @return mixed|null
     */
    public function getReceiptUuid($index)
    {
        $receipt = $this->getReceipt($index);
        return array_key_exists('uuid', $receipt) ? $receipt['uuid'] : null;
    }

    /**
     * Receipt shift number
     *
     * @param int $index
     *
     * @return int|null
     */
    public function getReceiptShiftNumber($index)
    {
        $receipt = $this->getReceipt($index);
        return array_key_exists('shift_number', $receipt) ? $receipt['shift_number'] : null;
    }

    /**
     * Receipt number
     *
     * @param int $index
     *
     * @return int|null
     */
    public function getReceiptNumber($index)
    {
        $receipt = $this->getReceipt($index);
        return array_key_exists('receipt_number', $receipt) ? $receipt['receipt_number'] : null;
    }

    /**
     * Receipt date time in the fiscalizer
     *
     * @param int $index
     *
     * @return string|null
     */
    public function getReceiptDatetime($index)
    {
        $receipt = $this->getReceipt($index);
        return array_key_exists('receipt_datetime', $receipt) ? $receipt['receipt_datetime'] : null;
    }

    /**
     * Fiscalizer number
     *
     * @param int $index
     *
     * @return string|null
     */
    public function getReceiptFnNumber($index)
    {
        $receipt = $this->getReceipt($index);
        return array_key_exists('fn_number', $receipt) ? $receipt['fn_number'] : null;
    }

    /**
     * Checkout equipment registration number
     *
     * @param int $index
     *
     * @return string|null
     */
    public function getReceiptDeviceNumber($index)
    {
        $receipt = $this->getReceipt($index);
        return array_key_exists('device_number', $receipt) ? $receipt['device_number'] : null;
    }

    /**
     * Fiscal document number
     *
     * @param int $index
     *
     * @return int|null
     */
    public function getReceiptFiscalDocumentNumber($index)
    {
        $receipt = $this->getReceipt($index);
        return array_key_exists('fiscal_document_number', $receipt) ? $receipt['fiscal_document_number'] : null;
    }

    /**
     * Fiscal document attribute
     *
     * @param int $index
     *
     * @return string|null
     */
    public function getReceiptFiscalDocumentAttribute($index)
    {
        $receipt = $this->getReceipt($index);
        return array_key_exists('fiscal_document_attribute', $receipt) ? $receipt['fiscal_document_attribute'] : null;
    }

    /**
     * Amount total
     *
     * @param int $index
     *
     * @return string|null
     */
    public function getReceiptAmountTotal($index)
    {
        $receipt = $this->getReceipt($index);
        return array_key_exists('amount_total', $receipt) ? $receipt['amount_total'] : null;
    }

    /**
     * Checkout equipment serial number
     *
     * @param int $index
     *
     * @return string|null
     */
    public function getReceiptDeviceSerialNumber($index)
    {
        $receipt = $this->getReceipt($index);
        return array_key_exists('serial_number', $receipt) ? $receipt['serial_number'] : null;
    }

    /**
     * The Federal Tax Service site url
     *
     * @param int $index
     *
     * @return string|null
     */
    public function getReceiptFTSSite($index)
    {
        $receipt = $this->getReceipt($index);
        return array_key_exists('fnsSite', $receipt) ? $receipt['fnsSite'] : null;
    }

    /**
     * OFD data
     *
     * @param int $index
     *
     * @return array
     */
    public function getReceiptOFD($index)
    {
        $receipt = $this->getReceipt($index);
        return array_key_exists('OFD', $receipt) ? $receipt['OFD'] : [];
    }

    /**
     * OFD operator name
     *
     * @param int $index
     *
     * @return string|null
     */
    public function getReceiptOFDName($index)
    {
        $receiptOFD = $this->getReceiptOFD($index);
        return array_key_exists('name', $receiptOFD) ? $receiptOFD['name'] : null;
    }

    /**
     * OFD operator site url
     *
     * @param int $index
     *
     * @return string|null
     */
    public function getReceiptOFDWebsite($index)
    {
        $receiptOFD = $this->getReceiptOFD($index);
        return array_key_exists('website', $receiptOFD) ? $receiptOFD['website'] : null;
    }

    /**
     * OFD operator INN
     *
     * @param int $index
     *
     * @return string|null
     */
    public function getReceiptOFDINN($index)
    {
        $receiptOFD = $this->getReceiptOFD($index);
        return array_key_exists('INN', $receiptOFD) ? $receiptOFD['INN'] : null;
    }
}