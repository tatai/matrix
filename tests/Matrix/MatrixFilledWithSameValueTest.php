<?php
class MatrixFilledWithSameValueTest extends PHPUnit_Framework_TestCase {
	private $_matrix = null;
	private $_x = null;
	private $_y = null;
	private $_filled_with = null;

	public function setUp() {
		$this->_x = 1;
		$this->_y = 3;
		$this->_filled_with = 3;
		
		$this->_matrix = MatrixFactory::createWithInitialValue($this->_x, $this->_y, $this->_filled_with);
	}
	
	/**
	 * @test
	 */
	public function givenValueMustBeNumeric() {
		$this->assertNull(MatrixFactory::createWithInitialValue(1, 2, array()));
	}

	/**
	 * @test
	 */
	public function canGetValuesFromAnyPosition() {
		$value = 3;
		for($i = 0; $i < $this->_x; $i++) {
			for($j = 0; $j < $this->_y; $j++) {
				$value |= $this->_matrix->get($i, $j);
			}
		}
		
		$this->assertEquals($this->_filled_with, $value);
	}

	/**
	 * @test
	 */
	public function getValueFromOutsidePositionReturnsFalse() {
		$this->assertFalse($this->_matrix->get(1, 3));
	}

	/**
	 * @test
	 */
	public function canSetValueInAnyCell() {
		$x = 0;
		$y = 2;
		$set = 10;
		$this->_matrix->set($x, $y, $set);
		
		$value = 3;
		$valueSum = 0;
		for($i = 0; $i < $this->_x; $i++) {
			for($j = 0; $j < $this->_y; $j++) {
				$get = $this->_matrix->get($i, $j);
				if($i != $x && $j != $y) {
					$value |= $get;
				}
				$valueSum += $get;
			}
		}

		$this->assertEquals($this->_filled_with, $value);
		$this->assertEquals($this->_filled_with * ($this->_x * $this->_y - 1) + $set, $valueSum);
	}
	
	/**
	 * @test
	 */
	public function settingValueInOutsidePositionReturnsFalse() {
		$this->assertFalse($this->_matrix->set(2, 3, 0));
	}
}