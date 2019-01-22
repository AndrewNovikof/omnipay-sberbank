<?php

namespace Omnipay\Sberbank\Tests\Message;

use Omnipay\Sberbank\Message\BindCardResponse;
use Omnipay\Sberbank\Message\CaptureRequest;

/**
 * Class CaptureRequestTest
 * @package Omnipay\Sberbank\Tests\Message
 */
class CaptureRequestTest extends AbstractRequestTest
{
    /**
     * Amount
     *
     * @var string
     */
    protected $amount;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        $this->amount = random_int(1000, 100000);
        
        parent::setUp();
    }

    /**
     * Get request class
     *
     * @return string
     */
    protected function getRequestClass()
    {
        return new CaptureRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    /**
     * Test request method
     *
     * @return string
     */
    public function getMethod()
    {
        $this->assertEquals('deposit.do', $this->request->getMethod());
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
            'amount' => $this->amount
        ];
    }

    /**
     * Test set Data
     *
     * @return mixed
     */
    public function testData()
    {
        $params = $this->getRequestParameters();
        $params['amount'] = $params['amount'] * 100;
        $this->assertEquals($this->request->getData(), $params);
    }

    /**
     * Test send success response
     *
     * @return mixed
     */
    public function testSendSuccess()
    {
        $this->setMockHttpResponse('CaptureRequestSuccess.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);
        /** @var BindCardResponse $response */
        $response = $this->request->send();
        
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals($response->getCode(), 0);
        $this->assertEquals($response->getMessage(), 'Обработка запроса прошла без системных ошибок');
    }

    /**
     * Test send fail response
     *
     * @return mixed
     */
    public function testSendError()
    {
        $this->setMockHttpResponse('CaptureRequestError.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);
        /** @var BindCardResponse $response */
        $response = $this->request->send();
        
        $this->assertFalse($response->isSuccessful());
        $this->assertEquals($response->getCode(), 6);
        $this->assertEquals($response->getMessage(), 'Незарегистрированный OrderId');
    }
}
