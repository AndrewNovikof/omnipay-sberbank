<?php

namespace Omnipay\Sberbank\Tests\Message;

use Omnipay\Sberbank\Message\BindCardRequest;
use Omnipay\Sberbank\Message\BindCardResponse;

/**
 * Class CaptureRequestTest
 * @package Omnipay\Sberbank\Tests\Message
 */
class CaptureRequestTest extends AbstractRequestTest
{
    /**
     * Binding id
     * 
     * @var string
     */
    protected $bindingId;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->bindingId = uniqid('bindingId-', true);
        
        parent::setUp();
    }

    /**
     * {@inheritdoc}
     */
    protected function getRequestParameters()
    {
        return array(
            'bindingId' => $this->bindingId
        );
    }
    /**
     * {@inheritdoc}
     */
    public function testData()
    {
        $this->assertEquals($this->request->getData(), $this->getRequestParameters());
    }

    /**
     * {@inheritdoc}
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
        $this->assertEquals($response->getMessage(), 'Успешно');
    }

    /**
     * {@inheritdoc}
     */
    public function testSendFail()
    {
        $this->setMockHttpResponse('BindCardRequestFail.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);
        /** @var BindCardResponse $response */
        $response = $this->request->send();
        
        $this->assertFalse($response->isSuccessful());
        $this->assertEquals($response->getCode(), 5);
        $this->assertEquals($response->getMessage(), 'Доступ запрещён');
    }

    /**
     * {@inheritdoc}
     */
    protected function getRequestClass()
    {
        return new BindCardRequest($this->getHttpClient(), $this->getHttpRequest());
    }
}
