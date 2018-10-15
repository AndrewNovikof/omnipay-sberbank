<?php

namespace Omnipay\Sberbank\Tests\Message;

use Omnipay\Sberbank\Message\GetBindingsRequest;
use Omnipay\Sberbank\Message\GetBindingsResponse;

/**
 * Class GetBindingsRequestTest
 * @package Omnipay\Sberbank\Tests\Message
 */
class GetBindingsRequestTest extends AbstractRequestTest
{
    /**
     * Client id
     *
     * @var string
     */
    protected $clientId;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        $this->clientId = uniqid('clientId-', true);
        
        parent::setUp();
    }

    /**
     * Get request class
     *
     * @return string
     */
    protected function getRequestClass()
    {
        return new GetBindingsRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    /**
     * Test request method
     *
     * @return string
     */
    public function getMethod()
    {
        $this->assertEquals('getBindings.do', $this->request->getMethod());
    }

    /**
     * Array of request parameters to successfully build request object
     *
     * @return array
     */
    protected function getRequestParameters()
    {
        return [
            'clientId' => $this->clientId
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

        /** @var GetBindingsResponse $response */
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

        /** @var GetBindingsResponse $response */
        $response = $this->request->send();
        
        $this->assertFalse($response->isSuccessful());
        $this->assertEquals($response->getCode(), 2);
        $this->assertEquals($response->getMessage(), 'Информация не найдена.');
    }
}
