<?php
namespace Siqwell\Omnipay;

use Illuminate\Support\ServiceProvider;
use Omnipay\Common\GatewayFactory;

/**
 * Class OmnipayServiceProvider
 * @package Siqwell\Omnipay
 */
class OmnipayServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/omnipay.php';

        $this->publishes([$configPath => config_path('omnipay.php')]);

        $this->app->singleton('omnipay', function ($app) {
            $defaults = $app['config']->get('omnipay.defaults', array());
            return new GatewayManager($app, new GatewayFactory, $defaults);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['omnipay'];
    }
}
