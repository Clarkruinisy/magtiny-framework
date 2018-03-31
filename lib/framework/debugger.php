<?php

namespace magtiny\framework;


final class debugger extends \exception
{
	public static function fetchException ($code = 0 ,$extra = "")
	{
		$exceptionMessage = config::exception($code);
		if ($extra) {
			$exceptionMessage.= "[ ".$extra." ]";
		}
		return $exceptionMessage;
	}

	public static function throwException ($code = 0, $extra = "")
	{
		$exceptionMessage = static::fetchException($code, $extra);
		throw new static($exceptionMessage, $code);
	}

	public static function handleException ($exception)
	{
		static::handle($exception->getMessage(), $exception->getFile(), $exception->getLine());
	}

	public static function handleError ($errno, $errstr, $errfile, $errline)
	{
		static::handle($errstr, $errfile, $errline);
	}

	private static function handle ($message = "", $file = "", $line = 0)
	{
		$error = "";
		if (config::config("debug")) {
			$template = ["{{message}}", "{{file}}", "{{line}}"];
			$replace = [$message, $file, $line];
			$error.= str_replace($template, $replace, config::config("errorTemplate"));
		}else{
			$error.= config::config("errorIgnore");
		}
		echo render::view($error);
	}
}
