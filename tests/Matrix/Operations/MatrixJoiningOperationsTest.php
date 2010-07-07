<?php
class MatrixJoiningOperationsTest extends PHPUnit_Framework_TestCase {
	private $_matrix = null;
	
	public function setup() {
		$this->_operations = new MatrixOperations();
		
		$this->_left = MatrixFactory::createWithInitialValue(2, 3, 0);
		$this->_left->set(0, 0, 2);
		$this->_left->set(0, 1, 6);
		$this->_left->set(0, 2, 1);
		$this->_left->set(1, 0, 4);
		$this->_left->set(1, 1, 1);
		$this->_left->set(1, 2, 3);

		$this->_right = MatrixFactory::createWithInitialValue(1, 3, 0);
		$this->_right->set(0, 0, 8);
		$this->_right->set(0, 1, 9);
		$this->_right->set(0, 2, 10);
		
	}

	/**
	 * @test
	 */
	public function joiningTwoCompatibleArrays() {
		$correct = MatrixFactory::createWithInitialValue(3, 3, 0);
		$correct->set(0, 0, 2);
		$correct->set(0, 1, 6);
		$correct->set(0, 2, 1);
		$correct->set(1, 0, 4);
		$correct->set(1, 1, 1);
		$correct->set(1, 2, 3);
		$correct->set(2, 0, 8);
		$correct->set(2, 1, 9);
		$correct->set(2, 2, 10);
		
		$join = $this->_operations->join($this->_left, $this->_right);
		
		$this->assertTrue($correct->isEqual($join));
	}
	
	/**
	 * @test
	 */
	public function joiningTwoIncompatibleArraysReturnsFalse() {
		$incompatible = MatrixFactory::createWithInitialValue(2, 2, 0);
		$join = $this->_operations->join($this->_left, $incompatible);
		
		$this->assertFalse($join);
	}
}