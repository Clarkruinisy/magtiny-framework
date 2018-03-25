<?php

namespace magtiny\framework;


final class magtiny
{
	public static function startKernal ()
	{
		echo "kernal started";
		error_reporting(E_ALL);

		// error handler register

		// exception handler register

		// session resister

		if (!defined("MAGTINY_APP_PATH")) {
			// app path not defined exception

		}
	}

	public static function startServer ()
	{
		echo "server started";
		$router = router::parse("PATH_INFO");
		// $result = (new $router->controller)->{$router->action};
		// $format = config::config("format");
		// render::$format($result);
	}
}