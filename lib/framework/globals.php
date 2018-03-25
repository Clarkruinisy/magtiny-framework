<?php

namespace magtiny\framework;


final class globals
{
	private static $globals=[];

	public static function __callStatic($method='', $argument=[])
	{
		$globalKey = '_' . strtoupper($method);
		if ('_SERVER' === $globalKey and !isset($GLOBALS[$globalKey])) {
			$GLOBALS[$globalKey] = $_SERVER;
		}
		if (!isset(static::$globals[$globalKey])){
			if (!isset($GLOBALS[$globalKey])){
				// globals key not exist exception

			}
			static::$globals[$globalKey] = $GLOBALS[$globalKey];
			// $filters=next($argument)?:Config::config('filter');
			// static::$globals[$globalKey]=Filter::handle($GLOBALS[$globalKey],$filters);
		}
		$paramKey = current($argument);
		if (!$paramKey){
			return static::$globals[$globalKey];
		}
		if (isset(static::$globals[$globalKey][$paramKey])){
			return static::$globals[$globalKey][$paramKey];
		}
		// globals key parameter key not exist exception
		
	}	

}