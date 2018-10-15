<?php

namespace Omnipay\Sberbank\Tests\Message;

use Omnipay\Sberbank\Message\ExtendedOrderStatusRequest;
use Omnipay\Sberbank\Message\ExtendedOrderStatusResponse;

/**
 * Class ExtendOrderStatusRequestTest
 * @package Omnipay\Sberbank\Tests\Message
 */
class ExtendedOrderStatusRequestTest extends AbstractRequestTest
{
    /**
     * Identifier of the bundle
     *
     * @var string
     */
    protected $orderId;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        $this->orderId = mt_rand(1, 100);

        parent::setUp();
    }

    /**
     * Array of request parameters to successfully build request object
     *
     * @return array
     */
    protected function getRequestParameters()
    {
        return [
            'orderId' => $this->orderId,
        ];
    }

    /**
     * Get request class
     *
     * @return string
     */
    protected function getRequestClass()
    {
        return new ExtendedOrderStatusRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    /**
     * Test request method
     *
     * @return string
     */
    public function getMethod()
    {
        return 'getOrderStatusExtended.do';
    }

    /**
     * Test getters and setters
     */
    public function testAdditionalGettersAndSetters()
    {
        $this->assertSame($this->request->setLanguage('ru'), $this->request);
        $this->assertEquals($this->request->getLanguage(), 'ru');
    }

    /**
     * Test set Data
     *
     * @return mixed
     */
    public function testData()
    {
        $this->assertEquals($this->request->getData(), $this->getRequestParameters());

        $this->request->setLanguage('en');

        $data = $this->request->getData();

        $this->assertEquals($data['language'], 'en');
    }

    /**
     * Test send success response
     *
     * @return mixed
     */
    public function testSendSuccess()
    {
        $this->setMockHttpResponse('ExtendedOrderStatusRequestSuccess.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var ExtendedOrderStatusResponse $response */
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals($response->getCode(), 0);
        $this->assertEquals($response->getMessage(), 'Обработка запроса прошла без системных ошибок');
        $this->assertEquals($response->getOrderStatus(), 2);
        $this->assertEquals($response->getOrderNumber(), 99999);
        $this->assertEquals($response->getAmount(), 150000);
        $this->assertEquals($response->getIp(), "111.111.111.111");
        $this->assertEquals($response->getDepositAmount(), 150000);

        $this->assertEquals($response->getMerchantOrderParams(), [
            [
                "name" => "param1",
                "value" => "value1"
            ],
            [
                "name" => "param2",
                "value" => "value2"
            ],
            [
                "name" => "param3",
                "value" => "value3"
            ],
        ]);

        $this->assertEquals($response->getExpiration(), "202012");
        $this->assertEquals($response->getCardHolderName(), "Ivan Ivanov");
        $this->assertEquals($response->getCurrency(), 643);
        $this->assertEquals($response->getApprovalCode(), 123456);
        $this->assertEquals($response->getPan(), "555555**5599");

        $this->assertEquals($response->getEci(), 13546564);
        $this->assertEquals($response->getCavv(), 356546);
        $this->assertEquals($response->getXid(), 4646465456);

        $this->assertEquals($response->getClientId(), 777777);
        $this->assertEquals($response->getBindingId(), 555555);

        $this->assertEquals($response->getAuthDateTime(), "2017-12-12T12:12:12");
        $this->assertEquals($response->getAuthRefNum(), 5456465436);
        $this->assertEquals($response->getTerminalId(), 13254);

        $this->assertEquals($response->getApprovedAmount(), 150000);
        $this->assertEquals($response->getDepositedAmount(), 150000);
        $this->assertEquals($response->getRefundedAmount(), 0);
        $this->assertEquals($response->getPaymentState(), 1);

        $this->assertEquals($response->getBankName(), "Sberbank");
        $this->assertEquals($response->getBankCountryCode(), 643);
        $this->assertEquals($response->getBankCountryName(), "Russia");
    }

    /**
     * Test send fail response
     *
     * @return mixed
     */
    public function testSendError()
    {
        $this->setMockHttpResponse('ExtendedOrderStatusRequestError.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var ExtendedOrderStatusResponse $response */
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals($response->getCode(), 3);
        $this->assertEquals($response->getMessage(), 'Авторизация отменена');
    }
}
