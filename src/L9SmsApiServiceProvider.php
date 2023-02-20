<?php

namespace Fitprime\L9SmsApi;

use Illuminate\Support\ServiceProvider;

class L9SmsApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // Bootstrap code here.
        $this->app->singleton(L9SmsApiChannel::class, function () {
            $config = config('l9smsapi');
            if (empty($config['token']) || empty($config['service'])) {
                throw new \Exception('L9SmsApi missing token and service in config');
            }

            return new L9SmsApiChannel($config['token'], $config['service']);
        });

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/l9smsapi.php' => config_path('l9smsapi.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/l9smsapi.php', 'l9smsapi');
    }
}
