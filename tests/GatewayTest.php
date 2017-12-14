<?php

namespace Omnipay\Sberbank\Tests;

use Omnipay\Common\Exception\BadMethodCallException;
use Omnipay\Sberbank\Gateway;
use Omnipay\Sberbank\Message\AuthorizeRequest;
use Omnipay\Sberbank\Message\BindCardRequest;
use Omnipay\Sberbank\Message\CaptureRequest;
use Omnipay\Sberbank\Message\ExtendedOrderStatusRequest;
use Omnipay\Sberbank\Message\GetBindingsRequest;
use Omnipay\Sberbank\Message\GetLastOrdersForMerchantsRequest;
use Omnipay\Sberbank\Message\OrderStatusRequest;
use Omnipay\Sberbank\Message\PurchaseRequest;
use Omnipay\Sberbank\Message\RefundRequest;
use Omnipay\Sberbank\Message\UnBindCardRequest;
use Omnipay\Sberbank\Message\UpdateSSLCardListRequest;
use Omnipay\Sberbank\Message\VerifyEnrollmentRequest;
use Omnipay\Sberbank\Message\VoidRequest;
use Omnipay\Tests\GatewayTestCase;

/**
 * Class GatewayTest
 * @package Omnipay\Sberbank\Tests
 */
class GatewayTest extends GatewayTestCase
{
    /**
     * Gateway
     *
     * @var Gateway
     */
    protected $gateway;

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
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        parent::setUp();

        $this->userName = uniqid('', true);
        $this->password = uniqid('', true);

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setTestMode(true)
            ->setUserName($this->userName)
            ->setPassword($this->password);
    }

    public function testAuthorize()
    {
        $this->assertTrue($this->gateway->supportsAuthorize());
        $this->assertTrue(method_exists($this->gateway, 'authorize'));
        $this->assertInstanceOf(AuthorizeRequest::class, $this->gateway->authorize());
    }

    public function testPurchase()
    {
        $this->assertTrue($this->gateway->supportsPurchase());
        $this->assertTrue(method_exists($this->gateway, 'purchase'));
        $this->assertInstanceOf(PurchaseRequest::class, $this->gateway->purchase());
    }

    public function testCompleteAuthorize()
    {
        $this->assertTrue($this->gateway->supportsCompleteAuthorize());
        $this->assertTrue(method_exists($this->gateway, 'completeAuthorize'));
        $this->assertInstanceOf(OrderStatusRequest::class, $this->gateway->completeAuthorize());
    }

    public function testCompletePurchase()
    {
        $this->assertTrue($this->gateway->supportsCompletePurchase());
        $this->assertTrue(method_exists($this->gateway, 'completePurchase'));
        $this->assertInstanceOf(OrderStatusRequest::class, $this->gateway->completePurchase());
    }

    public function testRefund()
    {
        $this->assertTrue($this->gateway->supportsRefund());
        $this->assertTrue(method_exists($this->gateway, 'refund'));
        $this->assertInstanceOf(RefundRequest::class, $this->gateway->refund());
    }

    public function testVoid()
    {
        $this->assertTrue($this->gateway->supportsVoid());
        $this->assertTrue(method_exists($this->gateway, 'void'));
        $this->assertInstanceOf(VoidRequest::class, $this->gateway->void());
    }

    public function testCapture()
    {
        $this->assertTrue($this->gateway->supportsCapture());
        $this->assertTrue(method_exists($this->gateway, 'capture'));
        $this->assertInstanceOf(CaptureRequest::class, $this->gateway->capture());
    }

    public function testStatus()
    {
        $this->assertTrue($this->gateway->supportsOrderStatus());
        $this->assertTrue(method_exists($this->gateway, 'orderStatus'));
        $this->assertInstanceOf(OrderStatusRequest::class, $this->gateway->orderStatus());
    }

    public function testExtendedStatus()
    {
        $this->assertTrue($this->gateway->supportsExtendedOrderStatus());
        $this->assertTrue(method_exists($this->gateway, 'extendedOrderStatus'));
        $this->assertInstanceOf(ExtendedOrderStatusRequest::class, $this->gateway->extendedOrderStatus());
    }

    public function testVerifyEnrollment()
    {
        $this->assertTrue($this->gateway->supportsVerifyEnrollment());
        $this->assertTrue(method_exists($this->gateway, 'verifyEnrollment'));
        $this->assertInstanceOf(VerifyEnrollmentRequest::class, $this->gateway->verifyEnrollment());
    }

    public function testGetLastOrdersForMerchants()
    {
        $this->assertTrue($this->gateway->supportsGetLastOrdersForMerchants());
        $this->assertTrue(method_exists($this->gateway, 'getLastOrdersForMerchants'));
        $this->assertInstanceOf(GetLastOrdersForMerchantsRequest::class, $this->gateway->getLastOrdersForMerchants());
    }

    public function testUpdateSSLCardList()
    {
        $this->assertTrue($this->gateway->supportsUpdateSSLCardList());
        $this->assertTrue(method_exists($this->gateway, 'updateSSLCardList'));
        $this->assertInstanceOf(UpdateSSLCardListRequest::class, $this->gateway->updateSSLCardList());
    }

    public function testBindCard()
    {
        $this->assertTrue($this->gateway->supportsBindCard());
        $this->assertTrue(method_exists($this->gateway, 'bindCard'));
        $this->assertInstanceOf(BindCardRequest::class, $this->gateway->bindCard());
    }

    public function testUnBindCard()
    {
        $this->assertTrue($this->gateway->supportsUnBindCard());
        $this->assertTrue(method_exists($this->gateway, 'unBindCard'));
        $this->assertInstanceOf(UnBindCardRequest::class, $this->gateway->unBindCard());
    }

    public function testGetBindings()
    {
        $this->assertTrue($this->gateway->supportsGetBindings());
        $this->assertTrue(method_exists($this->gateway, 'getBindings'));
        $this->assertInstanceOf(GetBindingsRequest::class, $this->gateway->getBindings());
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testDeleteCard()
    {
        $this->assertFalse($this->gateway->supportsDeleteCard());
        $this->assertTrue(method_exists($this->gateway, 'deleteCard'));
        $this->assertInstanceOf(BadMethodCallException::class, $this->gateway->deleteCard());
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testCreateCard()
    {
        $this->assertFalse($this->gateway->supportsCreateCard());
        $this->assertTrue(method_exists($this->gateway, 'createCard'));
        $this->assertInstanceOf(BadMethodCallException::class, $this->gateway->createCard());
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testUpdateCard()
    {
        $this->assertFalse($this->gateway->supportsUpdateCard());
        $this->assertTrue(method_exists($this->gateway, 'updateCard'));
        $this->assertInstanceOf(BadMethodCallException::class, $this->gateway->updateCard());
    }

    public function testSupportsCreateCard()
    {
        $supportsCreate = $this->gateway->supportsCreateCard();
        $this->assertInternalType('boolean', $supportsCreate);

        if ($supportsCreate) {
            $this->assertInstanceOf('Omnipay\Common\Message\RequestInterface', $this->gateway->createCard());
        }
    }

    public function testSupportsDeleteCard()
    {
        $supportsDelete = $this->gateway->supportsDeleteCard();
        $this->assertInternalType('boolean', $supportsDelete);

        if ($supportsDelete) {
            $this->assertInstanceOf('Omnipay\Common\Message\RequestInterface', $this->gateway->deleteCard());
        }
    }

    public function testSupportsUpdateCard()
    {
        $supportsUpdate = $this->gateway->supportsUpdateCard();
        $this->assertInternalType('boolean', $supportsUpdate);

        if ($supportsUpdate) {
            $this->assertInstanceOf('Omnipay\Common\Message\RequestInterface', $this->gateway->updateCard());
        }
    }
}
