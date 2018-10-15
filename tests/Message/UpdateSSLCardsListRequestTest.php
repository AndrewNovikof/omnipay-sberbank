<?php
namespace Omnipay\Sberbank\Tests\Message;

use Omnipay\Sberbank\Message\UpdateSSLCardListRequest;
use Omnipay\Sberbank\Message\UpdateSSLCardListResponse;

/**
 * Class UpdateSslCardsListRequestTest
 * @package Omnipay\Sberbank\Tests\Message
 */
class UpdateSSLCardsListRequestTest extends AbstractRequestTest
{
    /**
     * The order number in the payment system. Unique within the system.
     *
     * @var string
     */
    protected $mdorder;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        $this->mdorder = mt_rand(1, 100);

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
            'mdorder' => $this->mdorder,
        ];
    }

    /**
     * Get request class
     *
     * @return string
     */
    protected function getRequestClass()
    {
        return new UpdateSSLCardListRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    /**
     * Test request method
     *
     * @return string
     */
    public function getMethod()
    {
        return 'updateSSLCardList.do';
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
        $this->setMockHttpResponse('UpdateSSLCardsListRequestSuccess.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var UpdateSSLCardListResponse $response */
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
        $this->setMockHttpResponse('UpdateSSLCardsListRequestError.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var UpdateSSLCardListResponse $response */
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals($response->getCode(), 6);
        $this->assertEquals($response->getMessage(), 'Номер карты уже присутствует списке');
    }
}
