<?php

namespace TheWebbakery\OpenProvider\Requests;

use TheWebbakery\OpenProvider\Collections\OpenProviderCollection;
use TheWebbakery\OpenProvider\Exceptions\OpenProviderApiException;

class DNS extends BaseRequest
{
	protected string $prefix = "/dns";

	/**
	 * @param array $options
	 * @return OpenProviderCollection
	 * @throws OpenProviderApiException
	 * @link https://docs.openprovider.com/doc/all#operation/ListZoneRecords
	 */
	public function zoneRecords(string $domain, $options = []): OpenProviderCollection
	{
		return $this->get(sprintf('/zones/%s/records', $domain), $options);
	}

	/**
	 * @param array $options
	 * @return OpenProviderCollection
	 * @throws OpenProviderApiException
	 * @link https://docs.openprovider.com/doc/all#operation/GetZone
	 */
	public function getZone(string $domain, bool $withRecords = true, $options = []): OpenProviderCollection
	{
		return $this->get(sprintf('/zones/%s', $domain), array_merge(['with_records' => $withRecords ? 'true' : 'false'], $options));
	}

	/**
	 * @param array $options
	 * @return OpenProviderCollection
	 * @throws OpenProviderApiException
	 * @link https://docs.openprovider.com/doc/all#operation/GetZone
	 */
	public function updateZone(string $domain, $data = []): OpenProviderCollection
	{
		return $this->put(sprintf('/zones/%s', $domain), $data);
	}
}
