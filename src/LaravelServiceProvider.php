<?php
namespace Siqwell\Omnipay;

use Illuminate\Support\ServiceProvider;
use Omnipay\Common\GatewayFactory;

/**
 * Class LaravelServiceProvider
 * @package Siqwell\Omnipay
 */
class LaravelServiceProvider extends ServiceProvider
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
            return new GatewayManager($app, new GatewayFactory, $app['config']->get('omnipay.defaults', []));
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
