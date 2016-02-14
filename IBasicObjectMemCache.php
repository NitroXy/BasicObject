<?php
interface IBasicObjectMemCache {
	public function set($key, $var);
	public function get($key);
	public function delete($key);
}
