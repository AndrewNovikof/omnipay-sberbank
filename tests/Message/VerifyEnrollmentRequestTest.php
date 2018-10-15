<?php
namespace Omnipay\Sberbank\Tests\Message;

use Omnipay\Sberbank\Message\VerifyEnrollmentRequest;
use Omnipay\Sberbank\Message\VerifyEnrollmentResponse;

/**
 * Class VerifyEnrollmentRequestTest
 * @package Omnipay\Sberbank\Tests\Message
 */
class VerifyEnrollmentRequestTest extends AbstractRequestTest
{
    /**
     * @var string
     */
    protected $pan;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        $this->pan = mt_rand(1, 100);

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
            'pan' => $this->pan,
        ];
    }

    /**
     * Get request class
     *
     * @return string
     */
    protected function getRequestClass()
    {
        return new VerifyEnrollmentRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    /**
     * Test request method
     *
     * @return string
     */
    public function getMethod()
    {
        return 'verifyEnrollment';
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
        $this->setMockHttpResponse('VerifyEnrollmentRequestSuccess.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var VerifyEnrollmentResponse $response */
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals($response->getCode(), 0);
        $this->assertEquals($response->getMessage(), 'Успешно');
        $this->assertEquals($response->getEmitterName(), "TEST CARD");
        $this->assertEquals($response->getEmitterCountryCode(), "RU");
        $this->assertEquals($response->getEnrolled(), "Y");
    }

    /**
     * Test send fail response
     *
     * @return mixed
     */
    public function testSendError()
    {
        $this->setMockHttpResponse('VerifyEnrollmentRequestError.txt');

        $this->request->setUserName($this->userName);
        $this->request->setPassword($this->password);

        /** @var VerifyEnrollmentResponse $response */
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals($response->getCode(), 5);
        $this->assertEquals($response->getMessage(), 'Доступ запрещён');
    }
}
