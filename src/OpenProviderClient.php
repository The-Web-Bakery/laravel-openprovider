<?php

namespace TheWebbakery\OpenProvider;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use TheWebbakery\OpenProvider\Requests\DNS;
use TheWebbakery\OpenProvider\Requests\Domains;

class OpenProviderClient
{

	protected $httpClient;

	public function __construct()
	{
		$this->httpClient = Http::baseUrl(static::getBaseUrl())
			->acceptJson()
			->withHeaders(array_merge(OpenProviderAuth::getAuthorization(), []));
	}

	public static function getBaseUrl(string $prefix = null): string
	{
		$base = config('openprovider.base_url');
		if (!is_null($prefix) && !empty($prefix)) {
			if (!str_starts_with($prefix, '/')) {
				$prefix = sprintf('/%s', $base);
			}

			if (!str_ends_with($base, '/')) {
				return $base . $prefix;
			}

			return $base . $prefix;
		}

		return $base;
	}

	public function domains(): Domains
	{
		return new Domains($this->httpClient);
	}

	public function dns(): DNS
	{
		return new DNS($this->httpClient);
	}
}
