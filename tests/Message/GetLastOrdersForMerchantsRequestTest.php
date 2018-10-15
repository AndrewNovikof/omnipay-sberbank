<?php

namespace Omnipay\Sberbank\Tests\Message;

use Omnipay\Sberbank\Message\GetLastOrdersForMerchantsRequest;
use Omnipay\Sberbank\Message\GetLastOrdersForMerchantsResponse;

/**
 * Class GetLastOrdersForMerchantsRequestTest
 * @package Omnipay\Sberbank\Tests\Message
 */
class GetLastOrdersForMerchantsRequestTest extends AbstractRequestTest
{
    /**
     * Count elements on page
     *
     * @var string
     */
    protected $size;

    /**
     * Date and time of the beginning of the period for the selection of orders in the format YYYYMMDDHHmmss.
     *
     * @var string
     */
    private $from;

    /**
     * Date and time of the end of the period for the selection of orders in the format YYYYMMDDHHmmss.
     *
     * @var string
     */
    private $to;

    /**
     * Transaction of state
     *
     * @var string
     */
    private $transactionStates;

    /**
     * The list of Merchant Logins, whose transactions should be included in the report.
     * Multiple values are indicated by commas.
     *
     * @var string
     */
    private $merchants;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        $this->size = random_int(1, 200);
        $this->from = 20181112260000;
        $this->to = 20181212260000;
        $this->transactionStates = 'APPROVED';
        $this->merchants = '';

        parent::setUp();
    }

    /**
     * Get request class
     *
     * @return string
     */
    protected function getRequestClass()
    {
        return new GetLastOrdersForMerchantsRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    /**
     * Test request method
     *
     * @return string
     */
    public function getMethod()
    {
        $this->assertEquals('getLastOrdersForMerchants.do', $this->request->getMethod());
    }

    /**
     * Array of request parameters to successfully build request object
     *
     * @return array
     */
    protected function getRequestParameters()
    {
        return [
            'size' => $this->size,
            'from' => $this->from,
            'to' => $this->to,
            'transactionStates' => $this->transactionStates,
            'merchants' => $this->merchants
        ];
    }

    /**
     * Test set Data
     *
     * @return mixed
     */
    public function testData()
    {
        $this->assertEquals($this->request->getData(), $this->getRequestParameters());
    }

    /**
     * Test send success response
     *
     * @return mixed
     */
    public function testSendSuccess()
    {
        $this->setMockHttpResponse('GetLastOrdersForMerchantsRequestSuccess.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var GetLastOrdersForMerchantsResponse $response */
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals($response->getCode(), 0);
        $this->assertEquals($response->getMessage(), null);

        $this->assertEquals($response->getTotalCount(), 2);
        $this->assertEquals($response->getPage(), 0);
        $this->assertEquals($response->getPageSize(), 100);

        $this->assertEquals($response->getOrderErrorCode(0), 0);
        $this->assertEquals($response->getOrderNumber(0), "58drs0Pes459Hdsddd0567a0");
        $this->assertEquals($response->getOrderStatus(0), 2);
        $this->assertEquals($response->getActionCode(0), 0);
        $this->assertEquals($response->getActionCodeDescription(0), "Запрос успешно обработан");
        $this->assertEquals($response->getAmount(0), 250000);
        $this->assertEquals($response->getCurrency(0), 810);
        $this->assertEquals($response->getDate(0), 1414485649233);
        $this->assertEquals($response->getOrderDescription(0), "Opisanie");
        $this->assertEquals($response->getIp(0), "212.5.125.194");
        $this->assertEquals($response->getMerchantOrderParamName(0, 0), "registr1");
        $this->assertEquals($response->getMerchantOrderParamValue(0, 0), "registr1");
        $this->assertEquals($response->getAttributesName(0, 0), "mdOrder");
        $this->assertEquals($response->getAttributesValue(0, 0), "f1a3365b-542c-4c8d-b34c-e9a7ee8dbc9c");
        $this->assertEquals($response->getExpiration(0), "201512");
        $this->assertEquals($response->getCardholderName(0), "Ivan");
        $this->assertEquals($response->getApprovalCode(0), "123456");
        $this->assertEquals($response->getPan(0), "411111**1111");
        $this->assertEquals($response->getClientId(0), "666");
        $this->assertEquals($response->getBindingId(0), "1eabfb8e-b90e-4dc8-bef6-14bd392b1cec");
        $this->assertEquals($response->getAuthDateTime(0), 1414485661207);
        $this->assertEquals($response->getTerminalId(0), "111113");
        $this->assertEquals($response->getAuthRefNum(0), "111111111111");
        $this->assertEquals($response->getPaymentState(0), "DEPOSITED");
        $this->assertEquals($response->getApprovedAmount(0), 250000);
        $this->assertEquals($response->getDepositedAmount(0), 250000);
        $this->assertEquals($response->getRefundedAmount(0), 0);
        $this->assertEquals($response->getBankName(0), "TEST CARD");
        $this->assertEquals($response->getBankCountryName(0), "Россия");
        $this->assertEquals($response->getBankCountryCode(0), "RU");
    }

    /**
     * Test send fail response
     *
     * @return mixed
     */
    public function testSendError()
    {
        $this->setMockHttpResponse('GetBindingsCardByOrderOrIDRequestError.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var GetLastOrdersForMerchantsResponse $response */
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals($response->getCode(), 2);
        $this->assertEquals($response->getMessage(), 'Информация не найдена.');
    }
}
