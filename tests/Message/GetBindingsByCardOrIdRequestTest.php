<?php

namespace Omnipay\Sberbank\Tests\Message;

use Omnipay\Sberbank\Message\GetBindingsByCardOrIdRequest;
use Omnipay\Sberbank\Message\GetBindingsByCardOrIdResponse;

/**
 * Class GetBindingsByCardOrIdRequestTest
 * @package Omnipay\Sberbank\Tests\Message
 */
class GetBindingsByCardOrIdRequestTest extends AbstractRequestTest
{
    /**
     * Binding id
     *
     * @var string
     */
    protected $bindingId;

    /**
     * Pan code of card
     *
     * @var string
     */
    protected $pan;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        $this->bindingId = uniqid('bindingId-', true);
        $this->pan = uniqid('pan-', true);
        
        parent::setUp();
    }

    /**
     * Get request class
     *
     * @return string
     */
    protected function getRequestClass()
    {
        return new GetBindingsByCardOrIdRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    /**
     * Test request method
     *
     * @return string
     */
    public function getMethod()
    {
        $this->assertEquals('getBindingsByCardOrId.do', $this->request->getMethod());
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
     * Test getters and setters
     */
    public function testAdditionalGettersAndSetters()
    {
        $this->assertSame($this->request->setPan('5555555****5599'), $this->request);
        $this->assertEquals($this->request->getPan(), '5555555****5599');

        $this->assertSame($this->request->setShowExpired(true), $this->request);
        $this->assertEquals($this->request->getShowExpired(), true);
    }

    /**
     * Test send success response
     *
     * @return mixed
     */
    public function testSendSuccess()
    {
        $this->setMockHttpResponse('GetBindingsCardByOrderOrIdRequestSuccess.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var GetBindingsByCardOrIdResponse $response */
        $response = $this->request->send();
        
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals($response->getCode(), 0);
        $this->assertEquals($response->getMessage(), 'Обработка запроса прошла без системных ошибок');
        $this->assertEquals($response->getBindingId(0), 156456146);
        $this->assertEquals($response->getMaskedPan(0), "5555555****5599");
        $this->assertEquals($response->getExpiryDate(0), 201901);
        $this->assertEquals($response->getClientId(0), 113321);
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

        /** @var GetBindingsByCardOrIdResponse $response */
        $response = $this->request->send();
        
        $this->assertFalse($response->isSuccessful());
        $this->assertEquals($response->getCode(), 2);
        $this->assertEquals($response->getMessage(), 'Информация не найдена.');
    }
}
