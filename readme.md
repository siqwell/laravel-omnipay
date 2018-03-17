## Omnipay for Laravel 5.6

## Installation

Require this package in your composer.json and run composer update (or run `composer require siqwell/omnipay` directly):

    "siqwell/laravel-omnipay": "^0.1.8"

You need to publish the config for this package. A sample configuration is provided. The defaults will be merged with gateway specific configuration.

    $ php artisan vendor:publish

## Examples

    $params = [
        'amount' => $order->amount,
        'issuer' => $issuerId,
        'description' => $order->description,
        'returnUrl' => URL::action('PurchaseController@return', [$order->id]),
    ];
    
    $response = Omnipay::purchase($params)->send();

    if ($response->isSuccessful()) {
        // payment was successful: update database
        print_r($response);
    } elseif ($response->isRedirect()) {
        // redirect to offsite payment gateway
        return $response->getRedirectResponse();
    } else {
        // payment failed: display message to customer
        echo $response->getMessage();
    }

Besides the gateway calls, there is also a shortcut for the creditcard:

    $formInputData = array(
        'firstName' => 'Bobby',
        'lastName' => 'Tables',
        'number' => '4111111111111111',
    );
    
    $card = Omnipay::CreditCard($formInputData);
