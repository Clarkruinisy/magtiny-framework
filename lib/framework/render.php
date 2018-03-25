<?php

namespace magtiny\framework;


final class render
{
	public static function json ($data = "")
	{
		echo json_encode($data);
	}

	public static function html ($data = "")
	{
		echo $data;
	}
}