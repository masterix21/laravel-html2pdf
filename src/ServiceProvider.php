<?php

namespace masterix21\html2pdf;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/html2pdf.php' => config_path('html2pdf.php')
        ]);

        $this->mergeConfigFrom(__DIR__.'/config/html2pdf.php', 'html2pdf');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('html2pdf.wrapper', function($app) {
            return new PDF($app['view']);
        });
    }
}