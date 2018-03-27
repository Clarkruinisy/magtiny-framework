<?php

namespace magtiny\framework;


final class router
{
	private static $router = null;

	public static function parse ()
	{
		if (is_null(static::$router)) {
			$defaultRouter = config::config("router");
			$pathInfo = globals::server("PATH_INFO");

			$pathInfoArray = explode("/", $pathInfo);
			array_shift($pathInfoArray);
			$routerArray = ["app"];
			if (!isset($defaultRouter) or count($defaultRouter) < 2) {
				// default router not not exists or length should not be lt 2 exception
				die("default router not not exists or length should not be lt 2 exception");
			}
			foreach ($defaultRouter as $value) {
				$routerArray[] = ($path = array_shift($pathInfoArray)) ? $path : $value;
			}
			foreach ($pathInfoArray as $value) {
				if ($value) {
					$routerArray[] = $value;
				}
			}
			$router = new \stdClass;
			$router->action = array_pop($routerArray);
			$router->classname = array_pop($routerArray);
			$router->namespace = "\\" . implode("\\", $routerArray) . "\\controller";
			$router->controller = $router->namespace . "\\" . $router->classname;
			if (!class_exists($router->controller)) {
				// router class not exists exception
				die("router class not exists exception");
			}
			if (!method_exists($router->controller, $router->action)) {
				// router method not exist exception
				die("router method not exist exception");
			}
		}
		return $router;
	}
}