<?php
namespace Omnipay\Sberbank\Tests\Message;

use Omnipay\Sberbank\Message\ExtendBindingRequest;
use Omnipay\Sberbank\Message\ExtendBindingResponse;

/**
 * Class ExtendBindingRequestTest
 * @package Omnipay\Sberbank\Tests\Message
 */
class ExtendedBindingRequestTest extends AbstractRequestTest
{
    /**
     * Identifier of the bundle
     *
     * @var string
     */
    private $bindingId;

    /**
     * Expire date
     *
     * @var string
     */
    private $newExpiry;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        $this->bindingId = mt_rand(1, 100);
        $this->newExpiry = '201712';

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
            'bindingId' => $this->bindingId,
            'newExpiry' => $this->newExpiry,
        ];
    }

    /**
     * Get request class
     *
     * @return string
     */
    protected function getRequestClass()
    {
        return new ExtendBindingRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    /**
     * Test request method
     *
     * @return string
     */
    public function getMethod()
    {
        return 'extendBinding.do';
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
        $this->setMockHttpResponse('ExtendedBindCardRequestSuccess.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var ExtendBindingResponse $response */
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
        $this->setMockHttpResponse('ExtendedBindCardRequestError.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var ExtendBindingResponse $response */
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals($response->getCode(), 5);
        $this->assertEquals($response->getMessage(), 'Доступ запрещён');
    }
}
