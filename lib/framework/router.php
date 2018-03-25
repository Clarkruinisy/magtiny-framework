<?php

namespace magtiny\framework;


final class router
{
	public static function parse ($key = "PATH_INFO")
	{
		var_dump(globals::server($key));
	}
}