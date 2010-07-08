<?php
class MatrixJoiningOperationsTest extends PHPUnit_Framework_TestCase {
	private $_matrix = null;
	
	public function setup() {
		$left = array(
			array(2, 6, 1),
			array(4, 1, 3)
		);
		$this->_left = MatrixFactory::createFromArray(2, 3, $left);

		$right = array(
			array(8, 9, 10)
		);
		$this->_right = MatrixFactory::createFromArray(1, 3, $right);
	}

	/**
	 * @test
	 */
	public function joiningTwoCompatibleArrays() {
		$data = array(
			array(2, 6, 1),
			array(4, 1, 3),
			array(8, 9, 10)
		);
		$correct = MatrixFactory::createFromArray(3, 3, $data);
		
		$join = MatrixOperations::join($this->_left, $this->_right);
		
		$this->assertTrue($correct->isEqual($join));
	}
	
	/**
	 * @test
	 */
	public function joiningTwoIncompatibleArraysReturnsFalse() {
		$incompatible = MatrixFactory::createWithInitialValue(2, 2, 0);
		$join = MatrixOperations::join($this->_left, $incompatible);
		
		$this->assertFalse($join);
	}
}