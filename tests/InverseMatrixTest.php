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
	public function doInverse3x3() {

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

	/**
	 * @test
	 */
	public function doInverse2x2() {
		$values = array(
			array(1, 3),
			array(2, 4)
		);
		$this->_matrix->initFromArray(2, 2, $values);
		
		$res = $this->_operations->inverse($this->_matrix);
		
		$shouldBe = new Matrix();
		$values = array(
			array(-2, 1.5),
			array(1, -0.5)
		);
		$shouldBe->initFromArray(2, 2, $values);
		
		$this->assertTrue($res->isEqual($shouldBe));
	}

	/**
	 * @test
	 */
	public function doGaussJordanElimination() {
		/*
		$data = array(
			array(2, -1, 0),
			array(-1, 2, -1),
			array(0, -1, 2),
			array(1, 0, 0),
			array(0, 1, 0),
			array(0, 0, 1)
		);
		$this->_matrix->initFromArray(6, 3, $data);
		*/
		$data = array(
			array(1, -1, 3),
			array(1, -2, -7),
			array(2, 3, 4),
			array(8, 1, 10)
		);
		$this->_matrix->initFromArray(4, 3, $data);
		
		/*
		$expected = array(
			array(1, 0, 0),
			array(0, 1, 0),
			array(0, 0, 1),
			array(0.75, 0.5, 0.25),
			array(0.5, 1, 0.5),
			array(0.25, 0.5, 0.75)
		);
		$expectedMatrix = new Matrix();
		$expectedMatrix->initFromArray(6, 3, $expected);
		*/
		$expected = array(
			array(1, 0, 0),
			array(0, 1, 0),
			array(0, 0, 1),
			array(3, 1, 2)
		);
		$expectedMatrix = new Matrix();
		$expectedMatrix->initFromArray(4, 3, $expected);
		
		$resultFromGJE = $this->_operations->gaussJordanElimination($this->_matrix);
		
		$this->assertTrue($expectedMatrix->isEqual($resultFromGJE));
	}
}