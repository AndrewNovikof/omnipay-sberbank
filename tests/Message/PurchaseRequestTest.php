<?php
namespace Omnipay\Sberbank\Tests\Message;

use Omnipay\Sberbank\Message\ExtendedOrderStatusResponse;
use Omnipay\Sberbank\Message\PurchaseRequest;
use Omnipay\Sberbank\Message\PurchaseResponse;

/**
 * Class PurchaseRequestTest
 * @package Omnipay\Sberbank\Tests\Message
 */
class PurchaseRequestTest extends AbstractRequestTest
{
    /**
     * The order number in the payment system. Unique within the system.
     *
     * @var string
     */
    protected $mdOrder;

    /**
     * @var string
     */
    protected $ip;

    /**
     * The identifier of the bundle created when the order was paid or used for payment.
     * Is present only if the magazine is allowed to create bundles.
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
        $this->mdOrder = mt_rand(1, 10000);
        $this->bindingId = mt_rand(1, 100000);
        $this->ip = mt_rand(1, 10000200);

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
            'mdOrder' => $this->mdOrder,
            'bindingId' => $this->bindingId,
            'ip' => $this->ip
        ];
    }

    /**
     * Get request class
     *
     * @return string
     */
    protected function getRequestClass()
    {
        return new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    /**
     * Test request method
     *
     * @return string
     */
    public function getMethod()
    {
        return 'paymentOrderBinding.do';
    }

    /**
     * Test getters and setters
     */
    public function testAdditionalGettersAndSetters()
    {
        $this->assertSame($this->request->setLanguage('ru'), $this->request);
        $this->assertEquals($this->request->getLanguage(), 'ru');

        $this->assertSame($this->request->setCvc('808'), $this->request);
        $this->assertEquals($this->request->getCvc(), '808');

        $this->assertSame($this->request->setEmail('test@mail.ru'), $this->request);
        $this->assertEquals($this->request->getEmail(), 'test@mail.ru');
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
        $this->request->setCvc('808');
        $this->request->setEmail('test@mail.ru');

        $data = $this->request->getData();

        $this->assertEquals($data['language'], 'en');
        $this->assertEquals($data['cvc'], '808');
        $this->assertEquals($data['email'], 'test@mail.ru');
    }

    /**
     * Test send success response
     *
     * @return mixed
     */
    public function testSendSuccess()
    {
        $this->testSend3dsSuccess();
        $this->testSendSslSuccess();
    }

    public function testSend3dsSuccess()
    {
        $this->setMockHttpResponse('Purchase3dsRequestSuccess.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var PurchaseResponse $response */
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals($response->getCode(), 0);
        $this->assertEquals($response->getMessage(), null);
        $this->assertEquals($response->getInfo(), "Ваш платёж обработан, происходит переадресация...");
        $this->assertEquals($response->getAcsUrl(), "https://test.paymentgate.ru/acs/auth/start.do");
        $this->assertEquals($response->getPaReq(), "eJxVUdtugkAQ/RXCOy7LRdQMa2ixKU28pGrfyTICqSzKpcW/765AbR8mOWcyO");
        $this->assertEquals($response->getTermUrl(), "https://test.paymentgate.ru:443/testpayment/rest/finish3ds.do");
    }

    public function testSendSslSuccess()
    {
        $this->setMockHttpResponse('PurchaseSslRequestSuccess.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var PurchaseResponse $response */
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals($response->getCode(), 0);
        $this->assertEquals($response->getMessage(), null);
        $this->assertEquals($response->getInfo(), "Ваш платёж обработан, происходит переадресация...");
        $this->assertEquals($response->getRedirect(), "http://ya.ru?orderId=eb49300c-95b7-4dcd-9739-eee6c61f2ac4");
    }

    /**
     * Test send fail response
     *
     * @return mixed
     */
    public function testSendError()
    {
        $this->setMockHttpResponse('PurchaseRequestError.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var ExtendedOrderStatusResponse $response */
        $response = $this->request->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertEquals($response->getCode(), 5);
        $this->assertEquals($response->getMessage(), 'Access denied');
    }
}
