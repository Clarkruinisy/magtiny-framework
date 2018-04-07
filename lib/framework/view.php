<?php

namespace magtiny\framework;


final class view
{
	private $view = [];

	public function __construct ($file, $assign)
	{
		$this->view = [
			"file"		=> $file,
			"assign"	=> $assign,
			'include'	=> config::config("viewIncludeRegular"),
			'pattern' 	=> config::config("viewInlcudePattern"),
		];
	}

	public static function fetchFile ($view = "")
	{
		$view = $view ? $view : router::parse()->action;
		$controllerSpace = "\\".config::config("routerDirName")."\\";
		$viewSpace = "\\".config::config("viewDirName");
		if ($pos = strpos($view, "/")) {
			$path = str_replace($controllerSpace, $viewSpace."\\", router::parse()->namespace);
		}elseif ($pos === 0) {
			$path = str_replace($controllerSpace, $viewSpace, router::parse()->namespace);
		}else{
			$path = str_replace($controllerSpace, $viewSpace."\\", router::parse()->controller);
		}
		$file = getcwd()."/..".str_replace("\\", "/", $path)."/".$view.".".config::config("viewExtension");
		if (!is_file($file)) {
			debugger::throwException(109, $file);
		}
		return $file;
	}

	public function fetch ()
	{
		foreach ($this->view['assign'] as $key => $value) {
			$$key = $value;
		}
		ob_start();
		include $this->view['file'];
		$this->view['content'] = ob_get_contents();
		ob_clean();
		while (preg_match_all($this->view['include'], $this->view['content'], $this->view['matches'])) {
			foreach ($this->view['matches'][0] as $k => $this->view['match']) {
				preg_match($this->view['pattern'], $this->view['match'], $this->view['name'][$k]);
				include static::fetchFile(trim($this->view['name'][$k][0], "\""));
				$this->view['temp']['content'][$k] = ob_get_contents();
				ob_clean();
			}
			$this->view['content'] = str_replace($this->view['matches'][0], $this->view['temp']['content'], $this->view['content']);
		}
		ob_end_clean();
		return $this->view['content'];
	}
}

