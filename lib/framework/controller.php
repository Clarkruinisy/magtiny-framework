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
			debugger::throwException(102, render::json($key));
		}
	}

	final protected function view ($view = "") {
		$file = view::fetchFile($view);
		return (new view($file, $this->assign))->fetch();
	}
}
