<?php
namespace Omnipay\Sberbank\Tests\Message;

use Omnipay\Sberbank\Message\ExtendedOrderStatusResponse;
use Omnipay\Sberbank\Message\OrderStatusRequest;
use Omnipay\Sberbank\Message\OrderStatusResponse;
use Omnipay\Sberbank\Message\VoidRequest;
use Omnipay\Sberbank\Message\VoidResponse;

/**
 * Class VoidRequestTest
 * @package Omnipay\Sberbank\Tests\Message
 */
class VoidRequestTest extends AbstractRequestTest
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
    public function setUp(): void
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
        return new VoidRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    /**
     * Test request method
     *
     * @return string
     */
    public function getMethod()
    {
        return 'reverse.do';
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
        $this->setMockHttpResponse('VoidRequestSuccess.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var VoidResponse $response */
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
        $this->setMockHttpResponse('VoidRequestError.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var VoidResponse $response */
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals($response->getCode(), 6);
        $this->assertEquals($response->getMessage(), 'Незарегистрированный OrderId');
    }
}
