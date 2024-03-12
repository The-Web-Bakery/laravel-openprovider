<?php

namespace TheWebbakery\OpenProvider\Enums;

enum DNSType: string
{
	case A = 'A';
	case AAAA = 'AAAA';
	case CNAME = 'CNAME';
	case MX = 'MX';
	case SPF = 'SPF';
	case SRV = 'SRV';
	case TXT = 'TXT';
	case NS = 'NS';
	case TLSA = 'TLSA';
	case SSHFP = 'SSHFP';
	case CAA = 'CAA';

	public function isPriorityEligible(): bool
	{
		return match ($this) {
			self::MX => true,
			self::SRV => true,
			default => false
		};
	}
}
