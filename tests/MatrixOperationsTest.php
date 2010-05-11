<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once dirname(__FILE__) . '/../classes/Matrix.class.php';

class MatrixOperationsTest extends PHPUnit_Framework_TestCase {
	private $_matrix = null;

	public function setUp() {
		$this->_matrix = new Matrix();
		
		$this->_matrix->initWithValue(3, 3, 0);
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
		$matrix = new Matrix();
		
		$matrix->initWithValue(3, 3, 0);
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

	/**
	 * @test
	 */
	public function multiplyRowByTwo() {
		$matrix = new Matrix();
		
		$matrix->initWithValue(3, 3, 0);
		$matrix->set(0, 0, 2);
		$matrix->set(0, 1, 3);
		$matrix->set(0, 2, 3);
		$matrix->set(1, 0, 2);
		$matrix->set(1, 1, 4);
		$matrix->set(1, 2, 3);
		$matrix->set(2, 0, 2);
		$matrix->set(2, 1, 3);
		$matrix->set(2, 2, 4);
		
		$this->_matrix->multiplyRowBy(0, 2);
		
		$this->assertTrue($matrix->isEqual($this->_matrix));
	}

	/**
	 * @test
	 */
	public function multiplyColumnByTwo() {
		$matrix = new Matrix();
		
		$matrix->initWithValue(3, 3, 0);
		$matrix->set(0, 0, 2);
		$matrix->set(0, 1, 6);
		$matrix->set(0, 2, 6);
		$matrix->set(1, 0, 1);
		$matrix->set(1, 1, 4);
		$matrix->set(1, 2, 3);
		$matrix->set(2, 0, 1);
		$matrix->set(2, 1, 3);
		$matrix->set(2, 2, 4);
		
		$this->_matrix->multiplyColumnBy(0, 2);
		
		$this->assertTrue($matrix->isEqual($this->_matrix));
	}
}