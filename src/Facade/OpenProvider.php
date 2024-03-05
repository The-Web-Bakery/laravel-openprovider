<?php

namespace TheWebbakery\OpenProvider\Facade;
use Illuminate\Support\Facades\Facade;
use TheWebbakery\OpenProvider\OpenProviderClient;

/**
 * @mixin OpenProviderClient
 */
class OpenProvider extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return OpenProviderClient::class;
    }
}
