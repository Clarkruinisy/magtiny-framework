<?php

namespace magtiny\framework;


class session
{
	public static function prepare ()
	{
		if (config::config("sessionAutoStart")) {
			static::start();
		}
	}

	public static function started ()
	{
		return isset($_SESSION);
	}
	
	public static function start ()
	{
		if (static::started()) {
			debugger::throwException(110);
		}
		$sessionUse = config::config("sessionUse");
		if ("cookie" !== $sessionUse) {
			$sessionID = globals::$sessionUse(config::config("sessionKey"));
			if ($sessionID) {
				session_id($sessionID);
			}
		}
		session_start();
	}

	public static function set ($key = "" ,$value = null)
	{
		if (!static::started()) {
			debugger::throwException(111);
		}
		$_SESSION[$key] = $value;
		$newKey = filter::handle($key);
		$newValue = filter::handle($value);
		if (isset(globals::$globals["_SESSION"])) {
			globals::$globals["_SESSION"][$newKey] = $newValue;
		}
	}

	public static function get ($key = "")
	{
		if (!static::started()) {
			debugger::throwException(111);
		}
		return globals::session($key);
	}

	public static function destroy ()
	{
		if (!static::started()) {
			debugger::throwException(111);
		}
		$_SESSION = [];
		globals::$globals["_SESSION"] = [];
		session_destroy();
	}
}

