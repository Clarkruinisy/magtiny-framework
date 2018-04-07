<?php

namespace magtiny\framework;


final class magtiny
{
	public static function startServer ()
	{
		set_error_handler([__NAMESPACE__."\\debugger", "handleError"]);
		set_exception_handler([__NAMESPACE__."\\debugger", "handleException"]);
		error_reporting(E_ALL);
		// render must be before session
		render::prepare();
		session::prepare();
		$router = router::parse();
		$result = call_user_func_array([new $router->controller, $router->action], []);
		render::response($result);
	}
}

