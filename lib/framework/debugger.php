<?php

namespace magtiny\framework;


final class debugger extends \exception
{
	public static function prepare ()
	{
		set_error_handler([__NAMESPACE__."\\debugger", "handleError"]);
		set_exception_handler([__NAMESPACE__."\\debugger", "handleException"]);
	}

	public static function handleError ($errno, $errstr, $errfile, $errline)
	{
		static::handle($errstr, $errfile, $errline);
	}

	public static function handleException ($exception)
	{
		static::handle($exception->getMessage(), $exception->getFile(), $exception->getLine());
	}

	private static function handle ($message = "", $file = "", $line = 0)
	{
		$error = "";
		if (config::config("debug")) {
			$template = ["{{message}}", "{{file}}", "{{line}}"];
			$replace = [$message, $file, $line];
			$error.= str_replace($template, $replace, config::config("errorTempateMessage"));
		}else{
			$error.= config::config("errorIgnoreMessage");
		}
		echo $error;
	}

	public static function throwException ($code = 0, $extra = "")
	{
		$exceptionMessage = static::fetchException($code, $extra);
		throw new static($exceptionMessage, $code);
	}

	public static function fetchException ($code = 0 ,$extra = "")
	{
		$exceptionMessage = config::config("magtinyExceptions")[$code];
		if ($extra) {
			$exceptionMessage.= " [ ".$extra." ]";
		}
		return $exceptionMessage;
	}
}

