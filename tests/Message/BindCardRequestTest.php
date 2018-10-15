<?php

namespace Omnipay\Sberbank\Tests\Message;

use Omnipay\Sberbank\Message\BindCardRequest;
use Omnipay\Sberbank\Message\BindCardResponse;

/**
 * Class BindCardRequestTest
 * @package Omnipay\Sberbank\Tests\Message
 */
class BindCardRequestTest extends AbstractRequestTest
{
    /**
     * Binding id
     *
     * @var string
     */
    protected $bindingId;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        $this->bindingId = uniqid('bindingId-', true);
        
        parent::setUp();
    }

    /**
     * Get request class
     *
     * @return string
     */
    protected function getRequestClass()
    {
        return new BindCardRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    /**
     * Test request method
     *
     * @return string
     */
    public function getMethod()
    {
        $this->assertEquals('bindCard.do', $this->request->getMethod());
    }

    /**
     * Array of request parameters to successfully build request object
     *
     * @return array
     */
    protected function getRequestParameters()
    {
        return [
            'bindingId' => $this->bindingId
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
        $this->setMockHttpResponse('BindCardRequestSuccess.txt');

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
        $this->setMockHttpResponse('BindCardRequestError.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);
        /** @var BindCardResponse $response */
        $response = $this->request->send();
        
        $this->assertFalse($response->isSuccessful());
        $this->assertEquals($response->getCode(), 5);
        $this->assertEquals($response->getMessage(), 'Доступ запрещён');
    }
}
