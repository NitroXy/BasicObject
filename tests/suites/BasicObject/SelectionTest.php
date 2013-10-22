<?php

class SelectionTest extends DatabaseTestCase {
	public function testAutomaticJoin() {
		$m1 = Blueprint::make('Model1', "with_model2");

		$m1_ref = Model1::selection(array('model2.int1' => $m1->Model2()->int1));
		$this->assertCount(1, $m1_ref);
		$this->assertEquals($m1, $m1_ref[0]);
	}

	public function testManualJoin() {
		$m1 = Blueprint::make('Model1', array('int1' => 5000));
		$m2 = Blueprint::make('Model2', array('int1' => 5000, 'str1' => 'derp'));

		$m1_ref = Model1::selection(array( '@join' => array( 'model2:using' => 'int1'))	);
		$this->assertCount(1, $m1_ref);
		$this->assertEquals($m1, $m1_ref[0]);
	}

	public function testOrder() {
		$key = "ordertest";
		$m1 = Blueprint::make('Model1', array('int1' => 1, 'str1' => $key));
		$m2 = Blueprint::make('Model1', array('int1' => 2, 'str1' => $key));

		$selection = Model1::selection(array('str1' => $key, '@order' => 'int1'));
		$this->assertEquals($m1->id, $selection[0]->id);
		$this->assertEquals($m2->id, $selection[1]->id);

		$selection = Model1::selection(array('str1' => $key, '@order' => 'int1:desc'));
		$this->assertEquals($m2->id, $selection[0]->id);
		$this->assertEquals($m1->id, $selection[1]->id);
	}

	public function testIn() {
		$key = "testin";
		$m1 = Blueprint::make('Model1', array('int1' => 1, 'str1' => $key));
		$m2 = Blueprint::make('Model1', array('int1' => 2, 'str1' => $key));
		$m3 = Blueprint::make('Model1', array('int1' => 3, 'str1' => $key));
		$m4 = Blueprint::make('Model1', array('int1' => 4, 'str1' => $key));
		$m5 = Blueprint::make('Model1', array('int1' => 5, 'str1' => $key));

		$match_array = array(1, 2, 3);

		$selection = Model1::selection(array('str1' => $key, 'int1:in' => array(1, 2, 3)));
		$sorted_result = array_map(function($v) {
			return $v->int1;
		}, $selection);
		sort($sorted_result);

		$this->assertEquals($match_array, $sorted_result);
	}

	public function testNotIn() {
		$key = "testnotin";
		$m1 = Blueprint::make('Model1', array('int1' => 1, 'str1' => $key));
		$m2 = Blueprint::make('Model1', array('int1' => 2, 'str1' => $key));
		$m3 = Blueprint::make('Model1', array('int1' => 3, 'str1' => $key));
		$m4 = Blueprint::make('Model1', array('int1' => 4, 'str1' => $key));
		$m5 = Blueprint::make('Model1', array('int1' => 5, 'str1' => $key));

		$match_array = array(1, 2, 3);

		$selection = Model1::selection(array('str1' => $key, 'int1:not_in' => array(4, 5)));
		$sorted_result = array_map(function($v) {
			return $v->int1;
		}, $selection);
		sort($sorted_result);

		$this->assertEquals($match_array, $sorted_result);
	}

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage No such column 'foobar' in table 'model1' (value 'bar')
	 */
	public function testUnknowColumn() {
		Model1::selection(array('foobar' => 'bar'));
	}

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage No such table 'foobar'
	 */
	public function testInvalidJoin() {
		Model1::selection(array('foobar.foo' => 'a'));
	}

	/* TODO: Add much more tests */
}
