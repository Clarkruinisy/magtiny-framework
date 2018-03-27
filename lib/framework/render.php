<?php

namespace magtiny\framework;


final class render
{
	public static function response ($data = "")
	{
		if (is_array($data) or is_object($data)) {
			$data["memoryUsage"] = round(memory_get_usage()/1000, 1) . "KB";
			$runtimeDiffer = microtime(true) - APP_START_TIME;
			$data["runtime"] = round(1000 * $runtimeDiffer, 2) . "ms";
			echo json_encode($data);
		}elseif (!is_null($data)) {
			echo $data;
		}
	}
}