<?php

namespace TheWebbakery\OpenProvider\Enums;

use Illuminate\Support\Carbon;

enum DNSTTL: int
{

	case FIFTEENMINUTES = 900;
	case ONEHOUR = 3600;
	case THREEHOURS = 10800;
	case SIXHOURS = 21600;
	case TWELVEHOURS = 43200;
	case TWENTYFOURHOURS = 86400;

	public function toMinutes(): int
	{
		return $this->value / 60;
	}

	public function toHours(): int
	{
		return $this->toMinutes() / 60;
	}

	public function diffInTime(): int
	{
		return now()->addMinutes($this->toMinutes())->diff();
	}
}
