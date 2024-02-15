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
                    'merchantId' => 'k6wtcbd6dhy78psc',
                    'publicKey' => 'pv9zvb44h224yszk',
                    'privateKey' => 'c9d96869718f31773d6724ea27ff98a9'
                ]);
            }
        );
    }
}
