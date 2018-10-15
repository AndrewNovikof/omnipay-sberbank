<?php
namespace Omnipay\Sberbank\Tests\Message;

use Omnipay\Sberbank\Message\ExtendedOrderStatusResponse;
use Omnipay\Sberbank\Message\OrderStatusRequest;
use Omnipay\Sberbank\Message\OrderStatusResponse;

/**
 * Class OrderStatusRequestTest
 * @package Omnipay\Sberbank\Tests\Message
 */
class OrderStatusRequestTest extends AbstractRequestTest
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
        return new OrderStatusRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    /**
     * Test request method
     *
     * @return string
     */
    public function getMethod()
    {
        return 'getOrderStatus.do';
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
        $this->setMockHttpResponse('OrderStatusRequestSuccess.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var OrderStatusResponse $response */
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals($response->getCode(), 0);
        $this->assertEquals($response->getMessage(), 'Обработка запроса прошла без системных ошибок');
        $this->assertEquals($response->getOrderStatus(), 2);
        $this->assertEquals($response->getOrderNumber(), 99999);
        $this->assertEquals($response->getPan(), "555555**5599");
        $this->assertEquals($response->getExpiration(), "202012");
        $this->assertEquals($response->getCardHolderName(), "Ivan Ivanov");
        $this->assertEquals($response->getAmount(), 150000);
        $this->assertEquals($response->getCurrency(), 643);
        $this->assertEquals($response->getApprovalCode(), 123456);
        $this->assertEquals($response->getIp(), "111.111.111.111");
        $this->assertEquals($response->getClientId(), 777777);
        $this->assertEquals($response->getBindingId(), 555555);
        $this->assertEquals($response->getDepositAmount(), 150000);
    }

    /**
     * Test send fail response
     *
     * @return mixed
     */
    public function testSendError()
    {
        $this->setMockHttpResponse('OrderStatusRequestError.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var ExtendedOrderStatusResponse $response */
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals($response->getCode(), 3);
        $this->assertEquals($response->getMessage(), 'Авторизация отменена');
    }
}
