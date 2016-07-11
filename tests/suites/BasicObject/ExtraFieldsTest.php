<?php

class ExtraFieldsTest extends DatabaseTestCase {
	public function testSetCalled() {
		$data = ['int2' => 5];
		$model = ModelExtraFields::update_attributes($data, [
			'commit' => false,
		]);
		$this->assertEquals(15, $model->int1, 'int1 should be set via int2');
	}

	public function testOrder() {
		$data = ['int1' => 4, 'int2' => 5];
		$model = ModelExtraFields::update_attributes($data, [
			'commit' => false,
		]);
		$this->assertEquals(15, $model->int1, 'base fields should be set before extra fields');
	}

	public function testPermitNegative() {
		$data = ['int1' => 4, 'int2' => 5];
		$model = ModelExtraFields::update_attributes($data, [
			'commit' => false,
			'permit' => ['int1'],
		]);
		$this->assertEquals(4, $model->int1, 'int2 should be ignored if not listed in permit');
	}

	public function testPermitPositive() {
		$data = ['int1' => 4, 'int2' => 5];
		$model = ModelExtraFields::update_attributes($data, [
			'commit' => false,
			'permit' => ['int2'],
		]);
		$this->assertEquals(15, $model->int1, 'int2 should be used when listed in permit');
	}
}
