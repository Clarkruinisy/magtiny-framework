<?php

namespace magtiny\framework;


final class magtiny
{
	public static function startServer ()
	{
		error_reporting(E_ALL);

		if (!defined("MAGTINY_APP_PATH")) {
			// app path not defined exception

		}

		// error handler register

		// exception handler register

		// session resister

		$router = router::parse();
		$result = (new $router->controller)->{$router->action}();
		render::response($result);
	}
}