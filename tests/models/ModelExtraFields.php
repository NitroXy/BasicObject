<?php

class ModelExtraFields extends BasicObject {
	protected static function table_name() {
		return 'model1';
	}

	protected static function extra_fields() {
		return ['int2'];
	}

	public function __get($key) {
		switch ( $key ){
			case 'int2':
				return $this->int1 - 10;
				break;
			default:
				return parent::__get($key);
		}
	}

	public function __set($key, $value) {
		switch ( $key ){
			case 'int2':
				$this->int1 = $value + 10;
				break;
			default:
				parent::__set($key, $value);
		}
	}
};
