<?php

namespace Omnipay\Sberbank\Tests\Message;

use Omnipay\Sberbank\Message\GetBindingsByCardOrIdRequest;
use Omnipay\Sberbank\Message\GetBindingsByCardOrIdResponse;
use Omnipay\Sberbank\Message\GetBindingsRequest;
use Omnipay\Sberbank\Message\GetBindingsResponse;
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
    public function testGetMethod()
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
        $this->setMockHttpResponse('GetBindingsRequestSuccess.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var GetLastOrdersForMerchantsResponse $response */
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals($response->getCode(), 0);
        $this->assertEquals($response->getMessage(), 'Обработка запроса прошла без системных ошибок');
        $this->assertEquals($response->getBindingId(0), 156456146);
        $this->assertEquals($response->getMaskedPan(0), "5555555****5599");
        $this->assertEquals($response->getExpiryDate(0), 201901);
    }

    /**
     * Test send fail response
     *
     * @return mixed
     */
    public function testSendError()
    {
        $this->setMockHttpResponse('GetBindingsRequestError.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var GetLastOrdersForMerchantsResponse $response */
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals($response->getCode(), 2);
        $this->assertEquals($response->getMessage(), 'Информация не найдена.');
    }
}
