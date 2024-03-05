<?php

namespace TheWebbakery\OpenProvider;

use Illuminate\Support\Facades\Http;
use TheWebbakery\OpenProvider\Exceptions\OpenProviderAuthException;

class OpenProviderAuth {
    protected const CACHE_KEY = 'openprovider-auth';
    protected const CACHE_LIFETIME = 6 * 60 * 60; // 6 hours

    public static function getAuthorization() {
        return [
            'Authorization' => sprintf("Bearer %s", self::getBearerToken())
        ];
    }

    public static function getBearerToken(): ?string {
        if(cache()->has(self::CACHE_KEY)) {
            return cache()->get(self::CACHE_KEY)['token'];
        }

        return self::makeRequest();
    }

    protected static function makeRequest(): ?string {
        $request = Http::asJson()
            ->post(sprintf('%s/auth/login', config('openprovider.base_url')), [
                'ip' => config('openprovider.connections.default.ip'),
                'username' => config('openprovider.connections.default.username'),
                'password' => config('openprovider.connections.default.password'),
            ]);

        if(!$request->ok()) {
            throw new OpenProviderAuthException($request->collect()->get('desc'), $request->collect()->get('code'));
        }

        $token = $request->collect('data')->toArray();
        cache()->put(static::CACHE_KEY, $token, static::CACHE_LIFETIME);
        return $token['token'];
    }
}