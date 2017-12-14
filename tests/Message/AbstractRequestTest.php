<?php

namespace Omnipay\Sberbank\Tests\Message;

use Omnipay\Common\Exception\RuntimeException;
use Omnipay\Sberbank\Message\AbstractRequest;
use Omnipay\Tests\TestCase;

abstract class AbstractRequestTest extends TestCase
{
    /**
     * @var AbstractRequest
     */
    protected $request;

    /**
     * Gateway user name
     *
     * @var string
     */
    protected $userName;

    /**
     * Gateway password
     *
     * @var string
     */
    protected $password;

    /**
     * Order number
     *
     * @var string
     */
    protected $orderNumber;

    /**
     * Array of request parameters to successfully build request object
     *
     * @return array
     */
    abstract protected function getRequestParameters();

    /**
     * Get request class
     *
     * @return string
     */
    abstract protected function getRequestClass();

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        $this->request = $this->getRequestClass();
        $this->userName = uniqid('login', true);
        $this->password = uniqid('password', true);
        $this->orderNumber = uniqid('test_order', true);

        $this->request->initialize($this->getRequestParameters());
    }

//    public function testSendDataReturnsCorrectResponseClassInstance()
//    {
//        $this->setMockHttpResponse('AuthorizeRequestSuccess.txt');
//        $responseClass = $this->getResponseClassName();
//
//        if (!class_exists($responseClass)) {
//            throw new RuntimeException("Cannot find \"{$responseClass}\" class");
//        }
//
//        $this->assertInstanceOf($responseClass, $this->request->send());
//    }
//
//    public function testRequestShouldReturnErrorOnServerException()
//    {
//        $this->setMockHttpResponse('Request502.txt');
//
//        $this->assertRegExp('/Server error response/', $this->request->send()->getMessage());
//    }

    abstract public function testData();

    abstract public function testSendSuccess();

    abstract public function testSendFailure();
}
