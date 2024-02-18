<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this -> app -> singleton(
            Gateway::class,
            function($app){
                return new Gateway([
                    'environment' => 'sandbox',
                    'merchantId' => 'cznsj3xkwd68x79g',
                    'publicKey' => '4dxtbq42p5rxykmf',
                    'privateKey' => 'e7e1ef81b784de12e2a8e510ce74940d'
                ]);
            }
        );
    }
}
