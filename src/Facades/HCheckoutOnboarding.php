<?php
namespace Hubmais\HCheckoutOnboarding\Facades;

use Illuminate\Support\Facades\Facade;

class HCheckoutOnboarding extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'h-checkout-onboarding';
    }
}