<?php

namespace magtiny\framework;


final class magtiny
{
	public static function startServer ()
	{
		error_reporting(E_ALL);
		foreach (config::config("services") as $service) {
			call_user_func($service);
		}
		$router = router::parse();
		$result = call_user_func([new $router->controller, $router->action]);
		render::response($result);
	}
}

