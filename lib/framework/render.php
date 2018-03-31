<?php

namespace magtiny\framework;


final class render
{
	private static function serverStatus ()
	{
		return [
			"memoryUsage" => round(memory_get_usage()/1000, 1)."KB",
			"runtime" => round(1000 * (microtime(true) - APP_START_TIME), 2)."ms"
		];
	}

	public static function api ($code = 0, $success = false, $data = null)
	{
		return [
			"success" => $success,
			"code" => $code,
			"message" => config::message($code),
			"data" => $data,
		];
	}

	public static function json ($data = "")
	{
		return json_encode($data);
	}

	public static function view ($data = "")
	{
		return $data;
	}

	public static function response ($data = "")
	{
		if (is_array($data)) {
			if (config::config("serverStatus")) {
				$data = array_merge($data, static::serverStatus());
			}
			echo static::json($data);
		}elseif (is_object($data)) {
			echo static::json($data);
		}elseif (!is_null($data)) {
			echo static::view($data);
		}
	}
}
