<?php

namespace magtiny\framework;


final class config
{
	private static $config = [];

	private static function readConfigFile ($fileName = "config")
	{
		$appConfigFile = getcwd()."/../config/".$fileName.".php";
		if ("config" === $fileName) {
			$magtinyConfigFile = __DIR__."/../config.php";
			$magtinyConfig = include $magtinyConfigFile;
			if (is_file($appConfigFile)) {
				$appConfig = include $appConfigFile;
				return array_merge($magtinyConfig, $appConfig);
			}
			return $magtinyConfig;
		}elseif (is_file($appConfigFile)) {
			return include $appConfigFile;
		}
		debugger::throwException(100, $appConfigFile);
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
		if (!is_string($configKey) and !is_numeric($configKey)) {
			debugger::throwException(101, $configKey);
		}
		if (array_key_exists($configKey, static::$config[$method])){
			return static::$config[$method][$configKey];
		}
		return null;
	}
}

