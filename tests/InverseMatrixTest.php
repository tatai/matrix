<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once dirname(__FILE__) . '/../classes/Matrix.class.php';
require_once dirname(__FILE__) . '/../classes/MatrixOperations.class.php';

class InverseMatrixTest extends PHPUnit_Framework_TestCase {
	/**
	 * Matriz a usar
	 * 
	 * @var Matrix
	 * @private
	 */
	private $_matrix = null;

	public function setUp() {
		$this->_matrix = new Matrix();
		$this->_operations = new MatrixOperations();
	}

	/**
	 * @test
	 */
	public function givingNotSquareMatrixReturnsFalse() {
		$this->_matrix->initWithValue(2, 3, 4);
		
		$this->assertFalse($this->_operations->inverse($this->_matrix));
	}

	/**
	 * @test
	 */
	public function doInverse() {
		$this->_matrix->initWithValue(3, 3, 0);
		$this->_matrix->set(0, 0, 1);
		$this->_matrix->set(0, 1, 1);
		$this->_matrix->set(0, 2, 1);
		$this->_matrix->set(1, 0, 3);
		$this->_matrix->set(1, 1, 4);
		$this->_matrix->set(1, 2, 3);
		$this->_matrix->set(2, 0, 3);
		$this->_matrix->set(2, 1, 3);
		$this->_matrix->set(2, 2, 4);
		
		$res = $this->_operations->inverse($this->_matrix);
		
		$shouldBe = new Matrix();
		$shouldBe->initWithValue(3, 3, 0);
		$shouldBe->set(0, 0, 7);
		$shouldBe->set(0, 1, -1);
		$shouldBe->set(0, 2, -1);
		$shouldBe->set(1, 0, -3);
		$shouldBe->set(1, 1, 1);
		$shouldBe->set(1, 2, 0);
		$shouldBe->set(2, 0, -3);
		$shouldBe->set(2, 1, 0);
		$shouldBe->set(2, 2, 1);
		
		$this->assertTrue($res->isEqual($shouldBe));
	}
}