<?php

namespace magtiny\framework;


final class render
{
	private static function result ()
	{
		return [
			"memoryUsage" => round(memory_get_usage()/1000, 1)."KB",
			"runtime" => round(1000 * (microtime(true) - APP_START_TIME), 2)."ms"
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
			$result = array_merge($data, static::result());
			echo static::json($result);
		}elseif (is_object($data)) {
			echo static::json($data);
		}elseif (!is_null($data)) {
			echo static::view($data);
		}
	}
}
