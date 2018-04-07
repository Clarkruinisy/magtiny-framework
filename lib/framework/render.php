<?php

namespace magtiny\framework;


final class render
{
	private static function serverStatus ()
	{
		return [
			"memoryUsage" => round(memory_get_usage()/1000, 1)."KB",
			"runtime" => round(1000 * (microtime(true) - APP_START_TIME), 1)."ms"
		];
	}

	public static function prepare ()
	{
		if (config::config("crossDomain")) {
			header("Access-Control-Allow-Origin: ".config::config("domainName"));
		}
		$contentType = config::config("contentType");
		$charset = config::config("charset");
		header("Content-Type: ".$contentType.";charset= ".$charset);
	}

	public static function config ($file = "")
	{
		$configFile = $file ? $file : __DIR__."/../config.php";
		return include $configFile;
	}

	public static function response ($data = "")
	{
		if (is_array($data)) {
			if (config::config("reportRunningStatus")) {
				$data = array_merge($data, static::serverStatus());
			}
			echo json_encode($data);
		}elseif (is_object($data)) {
			echo json_encode($data);
		}elseif (is_string($data) or is_numeric($data)) {
			echo $data;
		}elseif (!is_null($data)) {
			print_r($data);
		}
	}
}

