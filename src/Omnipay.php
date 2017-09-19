<?php

namespace Siqwell\Omnipay;

use Illuminate\Support\Facades\Facade;
use Omnipay\Common\CreditCard;

/**
 * Class Facade
 * @package Barryvdh\Omnipay
 * @method static \Omnipay\Common\AbstractGateway gateway($name)
 */
class Omnipay extends Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'omnipay';
    }

    /**
     * @param  array $parameters
     *
     * @return CreditCard
     */
    public static function creditCard($parameters = null)
    {
        return new CreditCard($parameters);
    }
}
