<?php

namespace magtiny\framework;


final class globals
{
	public static $globals=[];

	public static function input ($key = "", $filters = [])
	{
		if (!isset(static::$globals[__FUNCTION__])) {
			$input = json_decode(file_get_contents("php://input"), true) ?? [];
			$filters= $filters ? $filters : config::config('safeFiltersFuncs');
			$input = filter::handle($input, $filters);
			static::$globals[__FUNCTION__] = array_merge($input, static::post());
		}
		if (!$key) {
			return static::$globals[__FUNCTION__];
		}
		if (isset(static::$globals[__FUNCTION__][$key])) {
			return static::$globals[__FUNCTION__][$key];
		}
		return null;
	}

	public static function __callStatic($method='', $argument=[])
	{
		$globalKey = '_' . strtoupper($method);
		if ('_SERVER' === $globalKey and !isset($GLOBALS[$globalKey])) {
			$_SERVER;
		}
		$paramKey = current($argument);
		if (!isset(static::$globals[$globalKey])) {
			if (!isset($GLOBALS[$globalKey])) {
				debugger::throwException(104, $globalKey);
			}
			$customFilters = next($argument);
			$filters = $customFilters ? $customFilters : config::config('safeFiltersFuncs');
			static::$globals[$globalKey] = filter::handle($GLOBALS[$globalKey], $filters);
		}
		if (!$paramKey) {
			return static::$globals[$globalKey];
		}
		if (isset(static::$globals[$globalKey][$paramKey])) {
			return static::$globals[$globalKey][$paramKey];
		}
		return null;
	}
}

