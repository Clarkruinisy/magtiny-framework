<?php

namespace magtiny\framework;


final class router
{
	private static $router = null;

	public static function parse ()
	{
		if (is_null(static::$router)) {

			$parseFrom = config::router("parse");
			$pathInfoArray = explode("/", globals::server($parseFrom));
			$pathInfoArray[0] = config::config("path");

			$defaultRouter = config::router("default");
			if (!isset($defaultRouter) or count($defaultRouter) < 3) {
				debugger::throwException(106, render::json($defaultRouter));
			}
			foreach ($defaultRouter as $value) {
				$routerArray[] = ($path = array_shift($pathInfoArray)) ? $path : $value;
			}
			foreach ($pathInfoArray as $value) {
				if ($value) {
					$routerArray[] = $value;
				}
			}
			static::$router = new \stdClass;
			static::$router->action = array_pop($routerArray);
			static::$router->classname = array_pop($routerArray);
			static::$router->namespace = "\\".implode("\\", $routerArray)."\\".config::router("dir")."\\";
			static::$router->controller = static::$router->namespace.static::$router->classname;
			if (!class_exists(static::$router->controller)) {
				debugger::throwException(107, static::$router->controller);
			}
			if (!method_exists(static::$router->controller, static::$router->action)) {
				debugger::throwException(108, static::$router->action);
			}
		}
		return static::$router;
	}
}
