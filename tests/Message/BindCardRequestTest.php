<?php

namespace Omnipay\PaymentgateRu\Message;

use Omnipay\Sberbank\Message\BindCardRequest;
use Omnipay\Sberbank\Message\BindCardResponse;

/**
 * Class CardBindRequestTest
 *
 * @package Omnipay\PaymentgateRu\Message
 * @property BindCardRequest $request
 */
class CardBindRequestTest extends AbstractRequestTest
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
     * Array of request parameters to successfully build request object
     *
     * @return array
     */
    protected function getRequestParameters()
    {
        return array(
            'bindingId' => $this->bindingId
        );
    }

    public function testData()
    {
        $this->assertEquals($this->request->getData(), $this->getRequestParameters());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('CardBindRequestSuccess.txt');
        
        /** @var BindCardResponse $response */
        $response = $this->request->send();
        
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals($response->getCode(), 0);
        $this->assertEquals($response->getMessage(), 'Успешно');
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('CardBindRequestFailure.txt');
        
        /** @var BindCardResponse $response */
        $response = $this->request->send();
        
        $this->assertFalse($response->isSuccessful());
        $this->assertEquals($response->getCode(), 2);
        $this->assertEquals($response->getMessage(), 'Неверное состояние связки');
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
}
