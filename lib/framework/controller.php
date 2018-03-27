<?php

namespace magtiny\framework;


class controller
{
	protected $assign = [];

	final protected function assign ($key = "", $value = null)
	{
		if (is_string($key)) {
			$this->assign[$key] = $value;
		}elseif (is_array($key) or is_object($key)) {
			foreach ($key as $k => $v) {
				$this->assign[$k] = $v;
			}
		}else{
			die("assign key not right exception");
		}
	}

	final protected function view ($view = "") {
		$view = $view ? $view : router::parse()->action;
		echo __DIR__;
	}
}