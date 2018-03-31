<?php

namespace magtiny\framework;


final class globals
{
	public static $globals=[];

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
			$filters= ($filters = next($argument)) ? $filters : config::config('filters');
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
