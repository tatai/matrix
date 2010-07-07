<?php
class MatrixOperationsTest extends PHPUnit_Framework_TestCase {
	private $_matrix = null;

	public function setUp() {
		$this->_matrix = MatrixFactory::createWithInitialValue(3, 3, 0);
		$this->_matrix->set(0, 0, 1);
		$this->_matrix->set(0, 1, 3);
		$this->_matrix->set(0, 2, 3);
		$this->_matrix->set(1, 0, 1);
		$this->_matrix->set(1, 1, 4);
		$this->_matrix->set(1, 2, 3);
		$this->_matrix->set(2, 0, 1);
		$this->_matrix->set(2, 1, 3);
		$this->_matrix->set(2, 2, 4);
	}

	/**
	 * @test
	 */
	public function oneMatrixCompareWithItselfIsEqual() {
		$this->assertTrue($this->_matrix->isEqual($this->_matrix));
	}

	/**
	 * @test
	 */
	public function oneMatrixCompareWithAnotherWithSameDataIsEqual() {
		$matrix = MatrixFactory::createWithInitialValue(3, 3, 0);
		$matrix->set(0, 0, 1);
		$matrix->set(0, 1, 3);
		$matrix->set(0, 2, 3);
		$matrix->set(1, 0, 1);
		$matrix->set(1, 1, 4);
		$matrix->set(1, 2, 3);
		$matrix->set(2, 0, 1);
		$matrix->set(2, 1, 3);
		$matrix->set(2, 2, 4);
		
		$this->assertTrue($this->_matrix->isEqual($matrix));
	}
}