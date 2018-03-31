<?php

namespace magtiny\framework;


class model
{
	protected $config = "";

	protected static $connect = [];

	protected static $instance = [];

	public static function instance ($config = [])
	{
		if (!isset(static::$instance[static::class])) {
			static::$instance[static::class] = new static($config);
		}
		return static::$instance[static::class];
	}

	final private function __construct ($config = [])
	{
		$this->config = $config ? $config : config::database();
		$this->config["dsn"] = "";
		$this->config["dsn"].= $this->config["type"];
		$this->config["dsn"].= ":host=".$this->config["host"];
		$this->config["dsn"].= ";port=".$this->config["port"];
		$this->config["dsn"].= ";dbname=".$this->config["dbname"];
		$this->config["key"] = $this->config["dsn"].$this->config["user"];
	}

	final private function connect ()
	{
		if (!isset(static::$connect[$this->config["key"]])) {
			static::$connect[$this->config["key"]] = new \PDO(
				$this->config["dsn"],
				$this->config["user"],
				$this->config["password"],
				$this->config["options"]
			);
		}
		return static::$connect[$this->config["key"]];
	}

	final public function __call($method = "", $argument = [])
	{
		if (method_exists($this->connect(), $method)){
			return call_user_func_array([$this->connect(), $method], $argument);
		}
		debugger::throwException(105, $method);
	}
}
