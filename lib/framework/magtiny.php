<?php

namespace magtiny\framework;


final class magtiny
{
	public static function startServer ()
	{
		set_error_handler(["\\magtiny\\framework\\debugger", "handleError"]);
		set_exception_handler(["\\magtiny\\framework\\debugger", "handleException"]);
		error_reporting(E_ALL);
		session::pareper();
		$router = router::parse();
		$result = (new $router->controller)->{$router->action}();
		render::response($result);
	}
}
