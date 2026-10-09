<?php
namespace Hubmais\HCheckoutOnboarding\Services;

use Hubmais\HClient\Client;

class Manager
{
    public function __construct(protected Client $client)
    {
    }

    public function onboarding(): OnboardingService
    {
        return new OnboardingService($this->client);
    }
}