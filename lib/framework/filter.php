<?php

namespace magtiny\framework;


final class filter
{
	public static function handle($data=[], $filters=[])
	{
		if (is_string($filters) and function_exists($filters)) {
			$data = static::treeHandle($data, $filter);
		}elseif (is_array($filters) or is_object($filters)) {
			foreach ($filters as $filter){
				if (is_string($filter) and function_exists($filter)) {
					$data = static::treeHandle($data,$filter);
				}else{
					debugger::throwException(103, render::json($filter));
				}
			}
		}else{
			debugger::throwException(103, render::json($filter));
		}
		return $data;
	}

	private static function treeHandle($data=[], $filter=[])
	{
		if (is_string($data)) {
			return $filter($data);
		}elseif (is_array($data) or is_object($data)) {
			foreach ($data as $key => $value) {
				$filterKey = $filter($key);
				if (is_string($key) and $key !== $filterKey) {
					unset($data[$key]);
					$data[$filterKey] = static::treeHandle($value, $filter);
				}else{
					$data[$key] = static::treeHandle($value, $filter);
				}
			}
		}
		return $data;
	}
}
