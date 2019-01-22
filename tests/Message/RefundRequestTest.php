<?php
namespace Omnipay\Sberbank\Tests\Message;

use Omnipay\Sberbank\Message\RefundRequest;
use Omnipay\Sberbank\Message\RefundResponse;

/**
 * Class RefundRequestTest
 * @package Omnipay\Sberbank\Tests\Message
 */
class RefundRequestTest extends AbstractRequestTest
{
    /**
     * Identifier of the bundle
     *
     * @var string
     */
    protected $orderId;

    /**
     * @var string
     */
    protected $amount;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        $this->orderId = mt_rand(1, 100);
        $this->amount = mt_rand(1, 100500);

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
            'amount' => $this->amount
        ];
    }

    /**
     * Get request class
     *
     * @return string
     */
    protected function getRequestClass()
    {
        return new RefundRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    /**
     * Test request method
     *
     * @return string
     */
    public function getMethod()
    {
        return 'refund.do';
    }

    /**
     * Test set Data
     *
     * @return mixed
     */
    public function testData()
    {
        $params = $this->getRequestParameters();
        $params['amount'] = $params['amount'] * 100;
        $this->assertEquals($this->request->getData(), $params);
    }

    /**
     * Test send success response
     *
     * @return mixed
     */
    public function testSendSuccess()
    {
        $this->setMockHttpResponse('RefundRequestSuccess.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var RefundResponse $response */
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals($response->getCode(), 0);
    }

    /**
     * Test send fail response
     *
     * @return mixed
     */
    public function testSendError()
    {
        $this->setMockHttpResponse('RefundRequestError.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var RefundResponse $response */
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals($response->getCode(), 5);
        $this->assertEquals($response->getMessage(), 'Ошибка значение параметра запроса');
    }
}
