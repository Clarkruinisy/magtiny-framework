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
			debugger::throwException(102, json_encode($key));
		}
	}

	final protected function view ($view = "")
	{
		$file = view::fetchFile($view);
		$viewInstance = new view($file, $this->assign);
		return $viewInstance->fetch();
	}

	final protected function render ($code = 10000, $success = false, $data = [], $extra = "")
	{
		$message = config::message($code);
		if (is_null($message)) {
			$router = router::parse();
			$message = "Send HTTP request to router";
			$message.= " [ ".$router->classname.'/'.$router->action." ] ";
			$message.= $success ? "success" : "failed";
		}
		if ($extra) {
			$message.= " [ ".$extra." ].";
		}
		return [
			"success" => $success,
			"code" =>$code,
			"message" => $message,
			"data" => $data,
		];
	}
}

