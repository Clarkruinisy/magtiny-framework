<?php

namespace magtiny\framework;


final class magtiny
{
	public static function startKernal ()
	{
		error_reporting(E_ALL);
		echo "kernal started";
	}

	public static function startServer ()
	{
		echo "server started";
	}
}