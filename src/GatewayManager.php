<?php
namespace Siqwell\Omnipay;

use Omnipay\Common\GatewayFactory;

/**
 * Class GatewayManager
 * @package Barryvdh\Omnipay
 */
class GatewayManager
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * The registered gateways
     */
    protected $gateways;

    /**
     * The default settings, applied to every gateway
     */
    protected $defaults;

    /**
     * @var GatewayFactory
     */
    protected $factory;

    /**
     * Create a new Gateway manager instance.
     *
     * @param                $app
     * @param GatewayFactory $factory
     * @param array          $defaults
     */
    public function __construct($app, GatewayFactory $factory, $defaults = array())
    {
        $this->app      = $app;
        $this->factory  = $factory;
        $this->defaults = $defaults;
    }

    /**
     * Get a gateway
     *
     * @param null $key
     *
     * @return mixed
     */
    public function gateway($key = null) // wmr
    {
        $key = $key ?: $this->getDefaultGateway();

        if (!isset($this->gateways[$key])) {

            $this->gateways[$key] = $this->factory->create(
                $this->getGatewayName($key),
                null,
                $this->app['request']
            )->initialize($this->getConfig($key));
        }

        return $this->gateways[$key];
    }

    /**
     * @param $key
     *
     * @return array
     */
    protected function getConfig($key)
    {
        return array_merge($this->defaults, $this->app['config']->get('omnipay.gateways.' . $key . '.parameters', []));
    }

    /**
     * @param $key
     *
     * @return string
     */
    protected function getGatewayName($key)
    {
        return $this->app['config']->get('omnipay.gateways.' . $key . '.gateway');
    }

    /**
     * Get the default gateway name.
     *
     * @return string
     */
    public function getDefaultGateway()
    {
        return $this->app['config']['omnipay.gateway'];
    }

    /**
     * Set the default gateway name.
     *
     * @param  string $name
     *
     * @return void
     */
    public function setDefaultGateway($name)
    {
        $this->app['config']['omnipay.gateway'] = $name;
    }

    /**
     * Dynamically call the default driver instance.
     *
     * @param  string $method
     * @param  array  $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->gateway(), $method], $parameters);
    }
}
