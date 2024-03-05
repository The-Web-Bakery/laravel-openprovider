<?php

namespace TheWebbakery\OpenProvider\Requests;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use TheWebbakery\OpenProvider\Collections\OpenProviderCollection;
use TheWebbakery\OpenProvider\Exceptions\OpenProviderApiException;
use TheWebbakery\OpenProvider\OpenProviderClient;

abstract class BaseRequest
{
	protected PendingRequest $httpClient;
	protected string $prefix = '';


	public function __construct(PendingRequest $httpClient)
	{
		$this->httpClient = $httpClient->baseUrl(OpenProviderClient::getBaseUrl($this->prefix));
	}

	/**
	 * @throws OpenProviderApiException
	 */
	public function post(string $url, array $data = [], array $options = []): OpenProviderCollection
	{
		$response = $this->httpClient->post($url, $data);

		if (!$response->successful()) {
			throw new OpenProviderApiException($response->collect('desc'));
		}

		return OpenProviderCollection::fromResponse($response, $url, $data);
	}

	/**
	 * @throws OpenProviderApiException
	 */
	public function put(string $url, array $data = [], array $options = []): OpenProviderCollection
	{
		$response = $this->httpClient->put($url, $data);

		if (!$response->successful()) {
			throw new OpenProviderApiException($response->collect('desc'));
		}

		return OpenProviderCollection::fromResponse($response, $url, $data);
	}

	/**
	 * @throws OpenProviderApiException
	 */
	public function delete(string $url, array $data = [], array $options = []): OpenProviderCollection
	{
		$response = $this->httpClient->delete($url, $data);

		if (!$response->successful()) {
			throw new OpenProviderApiException($response->collect('desc'));
		}

		return OpenProviderCollection::fromResponse($response, $url, $data);
	}

	/**
	 * @throws OpenProviderApiException
	 */
	public function get(string $url, array $options = []): OpenProviderCollection
	{
		$response = $this->httpClient->get($url, $options);

		if (!$response->successful()) {
			throw new OpenProviderApiException($response->collect('desc'));
		}

		return OpenProviderCollection::fromResponse($response, $url, $options);
	}
}
