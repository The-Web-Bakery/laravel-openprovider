<?php

namespace TheWebbakery\OpenProvider\Collections;

use Closure;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Collection;

class OpenProviderCollection extends Collection
{

	public static function fromResponse($response, string $url, array $requestData): self
	{
		$data = $response->collect('data');
		$items = collect([
			'data' => $data->get('results') ?? $data,
			'count' => $data->get('total') ?? null,
			'code' => $response->collect()->get('code'),
			'description' => $response->collect()->get('desc'),
			'response' => [
				'status' => $response->status(),
			],
			'request' => [
				'url' => $url,
				'data' => $requestData
			]
		]);

		return self::make($items);
	}

	public function forEach(callable $closure)
	{
		$ref = new \ReflectionFunction($closure);
		$hasKey = false;
		if ($args = $ref->getParameters()) {
			foreach ($args as $arg) {
				if ($arg->getType()->getName() === 'int') {
					$hasKey = true;
				}
			}
		}

		foreach ($this->data() as $key => $data) {
			if ($hasKey) {
				$closure($data, $key);
			} else {
				$closure($data);
			}
		}
	}

	public function data(): array
	{
		return $this->items['data'];
	}

	public function httpStatus(): int
	{
		return $this->items['response']['status'];
	}

	public function count(): int
	{
		return count($this->items['data']);
	}

	public function totalCount(): int
	{
		return $this->items['count'];
	}
}
