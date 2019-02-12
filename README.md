# Sberbank acquiring for PHP 

[![Build Status](https://travis-ci.org/AndrewNovikof/omnipay-sberbank.svg?branch=master)](https://travis-ci.org/AndrewNovikof/omnipay-sberbank)
[![Latest Stable Version](https://poser.pugx.org/andrewnovikof/omnipay-sberbank/v/stable)](https://packagist.org/packages/andrewnovikof/omnipay-sberbank)
[![Total Downloads](https://poser.pugx.org/andrewnovikof/omnipay-sberbank/downloads)](https://packagist.org/packages/andrewnovikof/omnipay-sberbank)
[![License](https://poser.pugx.org/andrewnovikof/omnipay-sberbank/license)](https://packagist.org/packages/andrewnovikof/omnipay-sberbank)

# Introduction

This library implements the work with [Sberbank acquiring api](https://developer.sberbank.ru/doc/v1/acquiring/rest-requests-about) via [theleague Omnipay](https://omnipay.thephpleague.com/) processing library for PHP. It has a clear and consistent API, is fully unit tested.

This package supports PHP 7.1 and higher 

# Download

## Composer 

```
// This assumes that you have composer installed globally
composer require andrewnovikof/omnipay-sberbank
```

## Solving problems with minimal stability

Add to your composer.json

```json
{
  "minimum-stability":"dev",
  "prefer-stable": true
}

```

# Simple Example

```php
use Omnipay\Omnipay;

// Setup payment gateway
$gateway = Omnipay::create('Sberbank');

// Set params for authorize request
$gateway->authorize(
    [
       'orderNumber' => $localOrderNumber, // local order number
       'amount' => $order_amount, // The amount of payment (you can use decimal with 2 precisions for copecs or string equal to decimal)
       'returnUrl' => $callback_url // succesfull callback url
    ]
);

// Enable test mode
$gateway->setTestMode(true);

// You can set parameters via setters, for example:
$gateway->setUserName('merchant_login')
        ->setPassword('merchant_password')
        ->setOrderNumber($localOrderNumber)
        ->setLanguage('en');

// Send request
$response = $gateway->send();

// Process response
if ($response->isSuccessful()) {
    
    // Payment was successful
    print_r($response);
    
    // Get gateway orderId
    $gatewayOrderId = $response->getOrderId();
    
    // Get manualy get redirect url to offsite payment gateway
    $offsiteGateway = $response->getRedirectUrl();
} else {
 
     // Payment failed
     echo $response->getMessage();
}

// Work with redirect
if ($response->isRedirect()) {
    
    // Redirect to offsite payment gateway
    $response->redirect();

} 

```

# Payment Methods
#### [Order registration without pre-authorization](#register.do)
#### [Order registration with pre-authorization](#registerPreAuth.do)
#### [Order completion after pre-authorization](#deposit.do)
#### [Orders status](#getOrderStatus.do)
#### [Extended order status](#getOrderStatusExtended.do)
#### [Void order](#reverse.do)
#### [Refund for an order payment](#refund.do)
#### [Verify the involvement of the map in 3DS](#verifyEnrollment)
#### [Statistics on payments for the period](#getLastOrdersForMerchants.do)
#### [Add a card to the list of SSL-cards](#updateSSLCardList.do)

<a name="register.do"></a>

# Order registration without pre-authorization

More about this request you'll see in Sberbank official [documentation -> item 1](https://developer.sberbank.ru/doc/v1/acquiring/rest-requests1pay) or in our source code

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('Sberbank');
$response = $gateway->authorize(
    [
       'orderNumber' => $localOrderNumber, // local order number
       'amount' => $order_amount, // The amount of payment (you can use decimal with 2 precisions for copecs or string equal to decimal)
       'returnUrl' => $callback_url, // succesfull callback url
       'description' => 'Order Description'
    ]
)->setUserName('merchant_login')
 ->setPassword('merchant_password')
 ->send();

// Process response
if ($response->isSuccessful()) {
    
    // Payment was successful
    print_r($response);
    
    // Get gateway orderId
    $gatewayOrderId = $response->getOrderId();
    
    // Get manualy get redirect url to offsite payment gateway
    $offsiteGateway = $response->getRedirectUrl();
} else {
 
     // Payment failed
     echo $response->getMessage();
}

// Work with redirect
if ($response->isRedirect()) {
    
    // Redirect to offsite payment gateway
    $response->redirect();

} 

```

<a name="registerPreAuth.do"></a>

# Order registration with pre-authorization

More about this request you'll see in Sberbank official [documentation -> item 1](https://developer.sberbank.ru/doc/v1/acquiring/rest-requests2pay) or in our source code

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('Sberbank');
$response = $gateway->authorize(
    [
       'orderNumber' => $localOrderNumber, // local order number
       'amount' => $order_amount, // The amount of payment (you can use decimal with 2 precisions for copecs or string equal to decimal)
       'returnUrl' => $callback_url, // succesfull callback url
       'description' => 'Order Description'
    ]
)->setTwoStage(true)
 ->setUserName('merchant_login')
 ->setPassword('merchant_password')
 ->send();

// Process response
if ($response->isSuccessful()) {
    
    // Payment was successful
    print_r($response);
    
    // Get gateway orderId
    $gatewayOrderId = $response->getOrderId();
    
    // Get manualy get redirect url to offsite payment gateway
    $offsiteGateway = $response->getRedirectUrl();
} else {
 
     // Payment failed
     echo $response->getMessage();
}

// Work with redirect
if ($response->isRedirect()) {
    
    // Redirect to offsite payment gateway
    $response->redirect();

} 

```

<a name="deposit.do"></a>

# Order completion after pre-authorization

More about this request you'll see in Sberbank official [documentation -> item 2](https://developer.sberbank.ru/doc/v1/acquiring/rest-requests2pay) or in our source code

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('Sberbank');
$response = $gateway->capture(
    [
       'orderId' => $localOrderNumber, // gateway order number
       'amount' => $order_amount, // The amount of payment (you can use decimal with 2 precisions for copecs or string equal to decimal)
    ]
)->setUserName('merchant_login')
 ->setPassword('merchant_password')
 ->send();

// Process response
if ($response->isSuccessful()) {

    // Get response code
    $code = $response->getCode();
} else {
 
     // Payment failed
     echo $response->getMessage();
}

```

<a name="getOrderStatus.do"></a>

# Orders status

More about this request you'll see in Sberbank official [documentation -> item 5](https://developer.sberbank.ru/doc/v1/acquiring/rest-requests2pay) or in our source code

This method work for `completeAuthorize()` and `completePurchase()` requests of Omnipay.

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('Sberbank');
$response = $gateway->orderStatus( // It will be similar to calling methods `completeAuthorize()` and `completePurchase()`
    [
       'orderId' => $localOrderNumber, // gateway order number
       'language' => 'en'
    ]
)->setUserName('merchant_login')
 ->setPassword('merchant_password')
 ->send();

// Process response
if ($response->isSuccessful()) {

    // Get response code
    $code = $response->getCode();
    
    // Get paid amount 
    $paid_amount = $response->getAmount();
            
    // Get other data
    $order_status = $response->getOrderStatus();
    $order_number = $response->getOrderNumber();
    $order_pan = $response->getPan();
    $order_expiration = $response->getExpiration();
    $order_cardholder_name = $response->getCardHolderName();
    $order_currency = $response->getCurrency();
    $order_approval_code = $response->getApprovalCode();
    $order_ip = $response->getIp();
    $order_client_id = $response->getClientId();
    $order_binding_id = $response->getBindingId();
} else {
 
     // Payment failed
     echo $response->getMessage();
}

```

<a name="getOrderStatusExtended.do"></a>

# Extended order status

More about this request you'll see in Sberbank official [documentation -> item 6](https://developer.sberbank.ru/doc/v1/acquiring/rest-requests2pay) or in our source code

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('Sberbank');
$response = $gateway->extendedOrderStatus(
    [
       'orderId' => $localOrderNumber, // gateway order number
       'language' => 'en'
    ]
)->setOrderNumber($localORderNumber) // You can set local orderNumber Instead of an orderId of gateway system
 ->setUserName('merchant_login')
 ->setPassword('merchant_password')
 ->send();
 
// Process response
if ($response->isSuccessful()) {

    // Get response code
    $code = $response->getCode();
    
    // Get paid amount 
    $paid_amount = $response->getAmount();
    
    // Get other data
    $order_status = $response->getOrderStatus();
    $order_number = $response->getOrderNumber();
    $order_pan = $response->getPan();
    $order_expiration = $response->getExpiration();
    $order_cardholder_name = $response->getCardHolderName();
    $order_currency = $response->getCurrency();
    $order_approval_code = $response->getApprovalCode();
    $order_ip = $response->getIp();
    $order_client_id = $response->getClientId();
    $order_binding_id = $response->getBindingId();
    $order_merchant_order_params = $response->getMerchantOrderParams();
    $order_eci = $response->getEci();
    $order_cavv = $response->getCavv();
    $order_xid = $response->getXid();
    $order_auth_date_time = $response->getAuthDateTime();
    $order_auth_ref_num = $response->getAuthRefNum();
    $order_terminal_id = $response->getTerminalId();
    $order_approved_amount = $response->getApprovedAmount();
    $order_deposited_amount = $response->getDepositedAmount();
    $order_refunded_amount = $response->getRefundedAmount();
    $order_payment_state = $response->getPaymentState();
    $order_bank_name = $response->getBankName();
    $order_bank_country_code = $response->getBankCountryCode();
    $order_band_country_name = $response->getBankCountryName();
} else {
 
     // Payment failed
     echo $response->getMessage();
}

```

<a name="reverse.do"></a>

# Void order

More about this request you'll see in Sberbank official [documentation -> item 3](https://developer.sberbank.ru/doc/v1/acquiring/rest-requests2pay) or in our source code

To request cancellation of payment for an order, use the request reverse.do. The cancellation function is available for a limited time after payment, the exact terms should be specified in the Bank.

The cancellation operation can only be performed once. If it ends with an error, then the repeated cancellation operation will fail.

This function is available to stores in consultation with the Bank. To perform the cancellation operation, the user must have the appropriate rights.

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('Sberbank');
$response = $gateway->void(
    [
       'orderId' => $localOrderNumber, // gateway order number
       'language' => 'en'
    ]
)->setUserName('merchant_login')
 ->setPassword('merchant_password')
 ->send();
 
// Process response
if ($response->isSuccessful()) {

    // Get response code
    $code = $response->getCode();
} else {

     // Payment failed
     echo $response->getMessage();
}

```

<a name="refund.do"></a>

# Refund for an order payment

More about this request you'll see in Sberbank official [documentation -> item 4](https://developer.sberbank.ru/doc/v1/acquiring/rest-requests2pay) or in our source code

For this request, the funds will be returned to the payer on the specified order. The request will end with an error if the funds for this order were not written off. The system allows you to return funds more than once, but in total no more than the original amount of write-off.

To perform a return operation, you must have the appropriate rights in the system.

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('Sberbank');
$response = $gateway->refund(
    [
       'orderId' => $localOrderNumber, // gateway order number
       'language' => 'en',
       'amount' => $oder_amount // // The amount of payment (you can use decimal with 2 precisions for copecs or string equal to decimal)
    ]
)->setUserName('merchant_login')
 ->setPassword('merchant_password')
 ->send();
 
// Process response
if ($response->isSuccessful()) {

    // Get response code
    $code = $response->getCode();
} else {

     // Payment failed
     echo $response->getMessage();
}

```

<a name="verifyEnrollment"></a>

# Verify the involvement of the map in 3DS

More about this request you'll see in Sberbank official [documentation -> item 7](https://developer.sberbank.ru/doc/v1/acquiring/rest-requests2pay) or in our source code

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('Sberbank');
$response = $gateway->verifyEnrollment(
    [
       'pan' => $cardPan
    ]
)->setUserName('merchant_login')
 ->setPassword('merchant_password')
 ->send();
 
// Process response
if ($response->isSuccessful()) {

    // Get response code
    $code = $response->getCode();
    
    $emitter_country_name = $response->getEmitterName();
    $emitter_country_code = $response->getEmitterCountryCode();
    $enrolled = $response->getEnrolled();
} else {

     // Payment failed
     echo $response->getMessage();
}

```

<a name="getLastOrdersForMerchants.do"></a>

# Statistics on payments for the period

More about this request you'll see in Sberbank official [documentation -> item 8](https://developer.sberbank.ru/doc/v1/acquiring/rest-requests2pay) or in our source code

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('Sberbank');
$response = $gateway->getLastOrdersForMerchants(
    [
       'size' => $size,
       'from' => $from,
       'to' => $to,
       'transactionStates' => $transactionStates,
       'merchants' => $merchants
    ]
)->setUserName('merchant_login')
 ->setPassword('merchant_password')
 ->send();
 
// Process response
if ($response->isSuccessful()) {

    // Get response code
    $code = $response->getCode();
    
    $total_count = $response->getTotalCount();
    $page = $response->getPage();
    $page_size = $response->getPageSize();

    // Available getters
    $response->getOrderErrorCode($orderIndex);
    $response->getOrderNumber($orderIndex);
    $response->getOrderStatus($orderIndex);
    $response->getActionCode($orderIndex);
    $response->getActionCodeDescription($orderIndex);
    $response->getAmount($orderIndex);
    $response->getCurrency($orderIndex);
    $response->getDate($orderIndex);
    $response->getOrderDescription($orderIndex);
    $response->getIp($orderIndex);
    $response->getMerchantOrderParamName($orderIndex, $paramIndex);
    $response->getMerchantOrderParamValue($orderIndex, $paramIndex);
    $response->getAttributesName($orderIndex, $attributeIndex);
    $response->getAttributesValue($orderIndex, $attributeIndex);
    $response->getExpiration($orderIndex);
    $response->getCardholderName($orderIndex);
    $response->getApprovalCode($orderIndex);
    $response->getPan($orderIndex);
    $response->getClientId($orderIndex);
    $response->getBindingId($orderIndex);
    $response->getAuthDateTime($orderIndex);
    $response->getTerminalId($orderIndex);
    $response->getAuthRefNum($orderIndex);
    $response->getPaymentState($orderIndex);
    $response->getApprovedAmount($orderIndex);
    $response->getDepositedAmount($orderIndex);
    $response->getRefundedAmount($orderIndex);
    $response->getBankName($orderIndex);
    $response->getBankCountryName($orderIndex);
    $response->getBankCountryCode($orderIndex);
} else {

     // Payment failed
     echo $response->getMessage();
}

```

<a name="updateSSLCardList.do"></a>

# Add a card to the list of SSL-cards

More about this request you'll see in Sberbank official [documentation -> item 9](https://developer.sberbank.ru/doc/v1/acquiring/rest-requests2pay) or in our source code

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('Sberbank');
$response = $gateway->verifyEnrollment(
    [
       'mdorder' => $mdorder
    ]
)->setUserName('merchant_login')
 ->setPassword('merchant_password')
 ->send();
 
// Process response
if ($response->isSuccessful()) {

    // Get response code
    $code = $response->getCode();
} else {

     // Payment failed
     echo $response->getMessage();
}

```
