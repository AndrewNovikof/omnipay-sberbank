# Sberbank acquiring for PHP 

This library implements the work with [Sberbank acquiring api](https://rsb2-eyufrolovichevasberbankru-dev.developer.eu.apiconnect.ibmcloud.com/acquiring-api-rest-about) via [theleague Omnipay](https://omnipay.thephpleague.com/) processing library for PHP. It has a clear and consistent API, is fully unit tested, and even comes with an example application to get you started.

[![Build Status](https://travis-ci.org/AndrewNovikof/omnipay-sberbank.svg?branch=master)](https://travis-ci.org/AndrewNovikof/omnipay-sberbank)
[![Latest Stable Version](https://poser.pugx.org/andrewnovikof/omnipay-sberbank/v/stable)](https://packagist.org/packages/andrewnovikof/omnipay-sberbank)
[![Total Downloads](https://poser.pugx.org/andrewnovikof/omnipay-sberbank/downloads)](https://packagist.org/packages/andrewnovikof/omnipay-sberbank)
[![License](https://poser.pugx.org/andrewnovikof/omnipay-sberbank/license)](https://packagist.org/packages/andrewnovikof/omnipay-sberbank)

# Download 



# Simple Example

```php
use Omnipay\Omnipay;

// Setup payment gateway
$gateway = Omnipay::create('Sberbank');

// Send purchase request
$response = $gateway->authorize(
    [
        'amount' => '10.00',
        'currency' => 'USD',
        'card' => $formData
    ]
)->send();

// Process response
if ($response->isSuccessful()) {
    
    // Payment was successful
    print_r($response);

} elseif ($response->isRedirect()) {
    
    // Redirect to offsite payment gateway
    $response->redirect();

} else {

    // Payment failed
    echo $response->getMessage();
}

```