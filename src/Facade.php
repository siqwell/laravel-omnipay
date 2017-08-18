<?php
namespace Siqwell\Omnipay;

use Omnipay\Common\CreditCard;

/**
 * Class Facade
 * @package Barryvdh\Omnipay
 */
class Facade extends \Illuminate\Support\Facades\Facade
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
