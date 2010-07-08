<?php
class SwapingColumnsTest extends PHPUnit_Framework_TestCase {
	/**
	 * 
	 * @var MatrixRowColumnOperations
	 */
	private $_operations = null;

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
		$this->_operations = new MatrixRowColumnOperations();
		
		$this->_matrix_data = array(
			array(1, 3, 5),
			array(2, 4, 6)
		);
		$this->_matrix = MatrixFactory::createFromArray(2, 3, $this->_matrix_data);
	}

	/**
	 * @test
	 */
	public function whenFirstColumnDoesNotExistsReturnsSameMatrix() {
		$test = clone $this->_matrix;
		$this->_operations->swapRows($test, 4, 1);
		
		$this->assertTrue($this->_matrix->isEqual($test));
	}

	/**
	 * @test
	 */
	public function whenSecondColumnDoesNotExistsReturnsSameMatrix() {
		$test = clone $this->_matrix;
		$this->_operations->swapRows($test, 1, 4);
		
		$this->assertTrue($this->_matrix->isEqual($test));
	}

	/**
	 * @test
	 */
	public function swapingTwoColumns() {
		$shouldBeData = array(
			array(2, 4, 6),
			array(1, 3, 5)
			);
		$shouldBe = MatrixFactory::createFromArray(2, 3, $shouldBeData);
		
		$this->_operations->swapColumns($this->_matrix, 0, 1);
		
		$this->assertTrue($this->_matrix->isEqual($shouldBe));
	}
}