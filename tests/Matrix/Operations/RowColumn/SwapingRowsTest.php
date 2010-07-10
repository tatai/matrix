<?php
class SwapingRowsTest extends PHPUnit_Framework_TestCase {
	/**
	 * 
	 * @var Matrix
	 */
	private $_matrix = null;
	
	/**
	 * 
	 * @var array
	 */
	private $_matrix_data = null;
	
	public function setup() {
		$this->_matrix_data = array(
			array(1, 3, 5),
			array(2, 4, 6)
		);
		$this->_matrix = MatrixFactory::createFromArray(2, 3, $this->_matrix_data);
	}

	/**
	 * @test
	 */
	public function whenFirstRowDoesNotExistsReturnsSameMatrix() {
		$test = clone $this->_matrix;
		MatrixRowColumnOperations::swapRows($test, 3, 1);
		
		$this->assertTrue($this->_matrix->isEqual($test));
	}

	/**
	 * @test
	 */
	public function whenSecondRowDoesNotExistsReturnsSameMatrix() {
		$test = clone $this->_matrix;
		MatrixRowColumnOperations::swapRows($test, 1, 3);
		
		$this->assertTrue($this->_matrix->isEqual($test));
	}

	/**
	 * @test
	 */
	public function swapingTwoRows() {
		$shouldBeData = array(
			array(3, 1, 5),
			array(4, 2, 6)
		);
		$shouldBe = MatrixFactory::createFromArray(2, 3, $shouldBeData);
		
		MatrixRowColumnOperations::swapRows($this->_matrix, 0, 1);
		
		$this->assertTrue($this->_matrix->isEqual($shouldBe));
	}
}