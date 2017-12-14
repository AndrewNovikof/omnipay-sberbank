<?php

namespace Omnipay\Sberbank\Message;

/**
 * Class GetLastOrdersForMerchantsRequest
 * @package Omnipay\Sberbank\Message
 */
class GetLastOrdersForMerchantsRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('size', 'from', 'to', 'transactionStates', 'merchants');

        $data = [
            'size' => $this->getSize(),
            'from' => $this->getFrom(),
            'to' => $this->getTo(),
            'transactionStates' => $this->getTransactionStates(),
            'merchants' => $this->getMerchants()
        ];

        return $this->specifyAdditionalParameters($data, ['language', 'page', 'searchByCreatedDate']);
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'getLastOrdersForMerchants.do';
    }

    /**
     * Get number of elements
     *
     * @return string
     */
    public function getSize()
    {
        return $this->getParameter('size');
    }

    /**
     * Set number of elements
     *
     * @param string $size
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setSize($size)
    {
        return $this->setParameter('size', $size);
    }

    /**
     * Get date and time of the beginning of the period for the selection of orders
     *
     * @return string
     */
    public function getFrom()
    {
        return $this->getParameter('from');
    }

    /**
     * Set date and time of the beginning of the period for the selection of orders in the format YYYYMMDDHHmmss.
     *
     * @param string $from
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setFrom($from)
    {
        return $this->setParameter('from', $from);
    }

    /**
     * Get date and time of the beginning of the period for the selection of orders
     *
     * @return string
     */
    public function getTo()
    {
        return $this->getParameter('to');
    }

    /**
     * Set date and time of the beginning of the period for the selection of orders in the format YYYYMMDDHHmmss.
     *
     * @param string $to
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setTo($to)
    {
        return $this->setParameter('to', $to);
    }

    /**
     * Get transaction states on selection
     *
     * @return string
     */
    public function getTransactionStates()
    {
        return $this->getParameter('transactionStates');
    }

    /**
     * Set transaction states on selection
     *
     * Multiple values are indicated by commas.
     * The possible values are: CREATED, APPROVED, DEPOSITED, DECLINED, REVERSED, REFUNDED.
     *
     * @param string $transactionStates
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setTransactionStates($transactionStates)
    {
        return $this->setParameter('transactionStates', $transactionStates);
    }

    /**
     * Get the list of Merchant Logins
     *
     * @return string
     */
    public function getMerchants()
    {
        return $this->getParameter('merchants');
    }

    /**
     * Set The list of Merchant Logins, whose transactions should be included in the report.
     *
     * Multiple values are indicated by commas.
     *
     * Leave this field blank to get a list of reports for all available merchants
     * (child merchants and merchants specified in the user settings).
     *
     * @param string $merchants
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setMerchants($merchants)
    {
        return $this->setParameter('merchants', $merchants);
    }

    /**
     * Get page number of selection
     *
     * @return string
     */
    public function getPage()
    {
        return $this->getParameter('page');
    }

    /**
     * Set page number of selection
     *
     * When processing the request, a list will be generated, divided into pages
     * (with the number of records size on one page). In the response, the page is returned with the number specified
     * in the page parameter. The page numbering begins at 0.
     * If the parameter is not specified, the page will be returned at the number 0.
     *
     * @param string $page
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setPage($page)
    {
        return $this->setParameter('page', $page);
    }

    /**
     * Get search by create date
     *
     * @return string
     */
    public function getSearchByCreatedDate()
    {
        return $this->getParameter('searchByCreatedDate');
    }

    /**
     * Set search by create date
     *
     * The possible values are:
     * true - search for orders, the creation date of which falls within the specified period.
     * false - search for orders whose payment date falls within the specified period (thus, orders can not be present
     * in the report in the status CREATED and DECLINED). The default value is false.
     *
     * @param boolean $searchByCreatedDate
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setSearchByCreatedDate($searchByCreatedDate)
    {
        return $this->setParameter('searchByCreatedDate', $searchByCreatedDate);
    }
}
