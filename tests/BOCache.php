<?php
include "../IBasicObjectMemCache.php";

class BOCache implements IBasicObjectMemCache {
	private static $instance;

	private $store = array();


	public static function get_instance() {
		if(empty(self::$instance)) {
			self::$instance = new BOCache();
		}
		return self::$instance;
	}

	public function set($key, $var) {
		$this->store[$key] = $var;
		return true;
	}

	public function get($key) {
		return isset($this->store[$key]) ? $this->store[$key] : false;
	}

	public function delete($key) {
		unset($this->store[$key]);
		return true;
	}
}
