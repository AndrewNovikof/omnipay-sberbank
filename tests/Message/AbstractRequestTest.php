<?php

namespace Omnipay\Sberbank\Tests\Message;

use Omnipay\Common\Exception\RuntimeException;
use Omnipay\Sberbank\Message\AbstractRequest;
use Omnipay\Tests\TestCase;

/**
 * Class AbstractRequestTest
 * @package Omnipay\Sberbank\Tests\Message
 */
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
    protected $orderId;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        $this->request = $this->getRequestClass();
        $this->userName = uniqid('login', true);
        $this->password = uniqid('password', true);
        $this->orderId = uniqid('orderId_', true);

        $this->request->initialize($this->getRequestParameters());
    }

    /**
     * Test set Data
     *
     * @return mixed
     */
    abstract public function testData();

    /**
     * Test send success response
     *
     * @return mixed
     */
    abstract public function testSendSuccess();

    /**
     * Test send fail response
     *
     * @return mixed
     */
    abstract public function testSendError();

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
     * Test request method
     *
     * @return string
     */
    abstract protected function getMethod();
}
