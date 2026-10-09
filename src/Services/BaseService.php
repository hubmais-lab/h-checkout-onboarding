<?php
namespace Hubmais\HCheckoutOnboarding\Services;

use Hubmais\HClient\Client;

abstract class BaseService
{
    public function __construct(protected Client $client)
    {
    }
}