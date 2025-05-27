<?php declare(strict_types = 1);

namespace SlevomatCodingStandard\Helpers;

use function function_exists;
use function iconv_strlen;
use function strlen;
use function strpos;
use function substr;

/**
 * @internal
 */
class StringHelper
{

	public static function startsWith(string $haystack, string $needle): bool
	{
		return $needle === '' || strpos($haystack, $needle) === 0;
	}

	public static function endsWith(string $haystack, string $needle): bool
	{
		return $needle === '' || substr($haystack, -strlen($needle)) === $needle;
	}

	public static function length(string $string, ?string $encoding = null): int
	{
		if ($encoding !== null && function_exists('iconv_strlen')) {
			$length = @iconv_strlen($string, $encoding);

			if ($length !== false) {
				return $length;
			}
		}

		return strlen($string);
	}

}
