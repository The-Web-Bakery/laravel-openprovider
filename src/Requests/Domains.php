<?php

namespace TheWebbakery\OpenProvider\Requests;

use TheWebbakery\OpenProvider\Collections\OpenProviderCollection;
use TheWebbakery\OpenProvider\Exceptions\OpenProviderApiException;

class Domains extends BaseRequest
{
	protected string $prefix = "/domains";

	/**
	 * @param array $options
	 * @return OpenProviderCollection
	 * @throws OpenProviderApiException
	 * @link https://docs.openprovider.com/doc/all#operation/ListDomains
	 */
	public function list(array $options = []): OpenProviderCollection
	{
		return $this->get('/', $options);
	}

	/**
	 * @param array $data
	 * @return OpenProviderCollection
	 * @throws OpenProviderApiException
	 * @link https://docs.openprovider.com/doc/all#operation/CreateDomain
	 */
	public function create(array $data = []): OpenProviderCollection
	{
		return $this->post('/', $data);
	}

	/**
	 * @param array $data
	 * @return OpenProviderCollection
	 * @throws OpenProviderApiException
	 * @link https://docs.openprovider.com/doc/all#operation/CreateDomain
	 */
	public function check(array $data = []): OpenProviderCollection
	{
		return $this->post('/check', $data);
	}

	public function getById(string $id, array $options = []): OpenProviderCollection
	{
		return $this->get(sprintf('/%s', $id), $options);
	}
}
