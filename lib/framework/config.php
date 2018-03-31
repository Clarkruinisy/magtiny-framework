<?php

namespace magtiny\framework;


final class config
{
	private static $config = [];

	private static function readConfigFile ($fileName = "config")
	{
		$configFile = getcwd()."/../config/".$fileName.".php";
		if (!is_file($configFile)) {
			debugger::throwException(100, $configFile);
		}
		return include $configFile;
	}

	public static function __callStatic ($method, $argument=[])
	{
		if (!isset(static::$config[$method])){
			static::$config[$method] = static::readConfigFile($method);
		}
		$configKey = current($argument);
		if (false === $configKey){
			return static::$config[$method];
		}
		if (array_key_exists($configKey, static::$config[$method])){
			return static::$config[$method][$configKey];
		}
		debugger::throwException(101, $method." => ".$configKey);
	}
}


