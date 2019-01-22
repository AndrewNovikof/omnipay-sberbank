<?php

namespace Omnipay\Sberbank\Tests\Message;

use Omnipay\Sberbank\Message\AuthorizeRequest;
use Omnipay\Sberbank\Message\AuthorizeResponse;

/**
 * Class AuthorizeRequestTest
 * @package Omnipay\Sberbank\Tests\Message
 */
class AuthorizeRequestTest extends AbstractRequestTest
{
    /**
     * Amount to pay
     *
     * @var float
     */
    protected $amount;

    /**
     * Success url
     *
     * @var string
     */
    protected $returnUrl;

    /**
     * Local order number
     *
     * @var string
     */
    protected $orderNumber;

    /**
     * Currency
     *
     * @var string
     */
    protected $currency;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        $this->amount = mt_rand(1, 100);
        $this->returnUrl = 'https://test.com/' . uniqid('', true);
        $this->orderNumber = uniqid('order_number_', true);
        $this->currency = 'RUB';

        parent::setUp();
    }

    /**
     * Get request class
     *
     * @return string
     */
    protected function getRequestClass()
    {
        return new AuthorizeRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    /**
     * Test request method
     *
     * @return string
     */
    public function getMethod()
    {
        $this->assertEquals('register.do', $this->request->getMethod());
        $this->request->setTwoStage(true);
        $this->assertEquals('registerPreAuth.do', $this->request->getMethod());
    }

    /**
     * Array of request parameters to successfully build request object
     *
     * @return array
     */
    protected function getRequestParameters()
    {
        return [
            'orderNumber' => $this->orderNumber,
            'amount' => $this->amount,
            'returnUrl' => $this->returnUrl,
            'currency' => $this->currency
        ];
    }

    /**
     * Test getters and setters
     */
    public function testAdditionalGettersAndSetters()
    {
        $this->assertSame($this->request->setCurrency('RUB'), $this->request);
        $this->assertEquals($this->request->getCurrency(), 'RUB');

        $this->assertSame($this->request->setFailUrl('http://test.test/error'), $this->request);
        $this->assertEquals($this->request->getFailUrl(), 'http://test.test/error');

        $this->assertSame($this->request->setDescription('Order Description'), $this->request);
        $this->assertEquals($this->request->getDescription(), 'Order Description');

        $this->assertSame($this->request->setLanguage('ru'), $this->request);
        $this->assertEquals($this->request->getLanguage(), 'ru');

        $this->assertSame($this->request->setPageView('DESKTOP'), $this->request);
        $this->assertEquals($this->request->getPageView(), 'DESKTOP');

        $this->assertSame($this->request->setClientId(123456), $this->request);
        $this->assertEquals($this->request->getClientId(), 123456);

        $this->assertSame($this->request->setMerchantLogin('test_login'), $this->request);
        $this->assertEquals($this->request->getMerchantLogin(), 'test_login');

        $this->assertSame($this->request->setJsonParams('{"param":"value"}'), $this->request);
        $this->assertEquals($this->request->getJsonParams(), '{"param":"value"}');

        $this->assertSame($this->request->setSessionTimeoutSecs(1800), $this->request);
        $this->assertEquals($this->request->getSessionTimeoutSecs(), 1800);

        $this->assertSame($this->request->setExpirationDate('2017-12-12T12:12:12'), $this->request);
        $this->assertEquals($this->request->getExpirationDate(), '2017-12-12T12:12:12');

        $this->assertSame($this->request->setBindingId(654321), $this->request);
        $this->assertEquals($this->request->getBindingId(), 654321);
    }

    /**
     * Test set Data
     *
     * @return mixed
     */
    public function testData()
    {
        $this->assertEquals($this->getRequestParameters(), $this->request->getData());

        $this->request
            ->setLanguage('ru')
            ->setPageView('MOBILE')
            ->setSessionTimeoutSecs(1800)
            ->setBindingId(123456)
            ->setExpirationDate('2017-12-12T12:12:12')
            ->setFailUrl('https://test.com/fail')
            ->setClientId(654321)
            ->setMerchantLogin('testLogin')
            ->setCurrency('RUB');

        $data = $this->request->getData();

        $this->assertEquals($data['language'], 'ru');
        $this->assertEquals($data['pageView'], 'MOBILE');
        $this->assertEquals($data['sessionTimeoutSecs'], 1800);
        $this->assertEquals($data['bindingId'], 123456);
        $this->assertEquals($data['expirationDate'], '2017-12-12T12:12:12');
        $this->assertEquals($data['failUrl'], 'https://test.com/fail');
        $this->assertEquals($data['clientId'], 654321);
        $this->assertEquals($data['merchantLogin'], 'testLogin');
        $this->assertEquals($data['currency'], 'RUB');
    }

    /**
     * Test send success response
     *
     * @return mixed
     */
    public function testSendSuccess()
    {
        $this->setMockHttpResponse('AuthorizeRequestSuccess.txt');

        /** @var AuthorizeResponse $response */
        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertEquals($response->getRedirectMethod(), 'GET');
        $this->assertEmpty($response->getRedirectData());
        $this->assertNull($response->getCode());
        $this->assertNull($response->getMessage());
        $this->assertEquals($response->getOrderId(), '61351fbd-ac25-484f-b930-4d0ce4101ab7');
        $this->assertEquals(
            $response->getRedirectUrl(),
            'https://3dsec.sberbank.ru/payment/merchants/kinohod/payment_ru.html?mdOrder=61351fbd-ac25-484f-b930-4d0ce4101ab7'
        );
    }

    /**
     * Test send fail response
     *
     * @return mixed
     */
    public function testSendError()
    {
        $this->setMockHttpResponse('AuthorizeRequestError.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);
        /** @var AuthorizeResponse $response */
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEquals($response->getCode(), 1);
        $this->assertEquals($response->getMessage(), 'Заказ с таким номером уже обработан');
        $this->assertNull($response->getTransactionId());
    }
}
