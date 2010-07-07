<?php
class MatrixRowColumnOperationsTest extends PHPUnit_Framework_TestCase {
	/**
	 * 
	 * @var Matrix
	 */
	private $_matrix = null;

	/**
	 * 
	 * @var MatrixRowColumnOperations
	 */
	private $_operations = null;

	public function setUp() {
		$this->_operations = new MatrixRowColumnOperations();
		
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
	public function multiplyRowByTwo() {
		$matrix = MatrixFactory::createWithInitialValue(3, 3, 0);
		$matrix->set(0, 0, 2);
		$matrix->set(0, 1, 3);
		$matrix->set(0, 2, 3);
		$matrix->set(1, 0, 2);
		$matrix->set(1, 1, 4);
		$matrix->set(1, 2, 3);
		$matrix->set(2, 0, 2);
		$matrix->set(2, 1, 3);
		$matrix->set(2, 2, 4);
		
		$this->_operations->multiplyRowBy($this->_matrix, 0, 2);
		
		$this->assertTrue($matrix->isEqual($this->_matrix));
	}

	/**
	 * @test
	 */
	public function multiplyColumnByTwo() {
		$matrix = MatrixFactory::createWithInitialValue(3, 3, 0);
		$matrix->set(0, 0, 2);
		$matrix->set(0, 1, 6);
		$matrix->set(0, 2, 6);
		$matrix->set(1, 0, 1);
		$matrix->set(1, 1, 4);
		$matrix->set(1, 2, 3);
		$matrix->set(2, 0, 1);
		$matrix->set(2, 1, 3);
		$matrix->set(2, 2, 4);
		
		$this->_operations->multiplyColumnBy($this->_matrix, 0, 2);
		
		$this->assertTrue($matrix->isEqual($this->_matrix));
	}
}