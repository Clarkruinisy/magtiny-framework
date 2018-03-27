<?php

namespace magtiny\framework;


final class globals
{
	private static $globals=[];

	public static function __callStatic($method='', $argument=[])
	{
		$globalKey = '_' . strtoupper($method);
		if ('_SERVER' === $globalKey and !isset($GLOBALS[$globalKey])) {
			$_SERVER;
		}
		$paramKey = current($argument);
		if (!isset(static::$globals[$globalKey])){
			if (!isset($GLOBALS[$globalKey])){
				// globals key not exist exception
				die("globals key not exist");
			}
			// static::$globals[$globalKey] = $GLOBALS[$globalKey];
			$filters= ($filters = next($argument)) ? $filters : config::config('filters');
			// var_dump($filters); die;
			static::$globals[$globalKey]=filter::handle($GLOBALS[$globalKey], $filters);
		}
		// var_dump($paramKey);die;
		if (!$paramKey){
			return static::$globals[$globalKey];
		}
		if (isset(static::$globals[$globalKey][$paramKey])){
			return static::$globals[$globalKey][$paramKey];
		}
		return null;
	}
}