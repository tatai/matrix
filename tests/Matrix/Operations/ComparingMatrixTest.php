<?php
class ComparingMatrixTest extends PHPUnit_Framework_TestCase {
	private $_matrix = null;

	public function setUp() {
		$data = array(
			array(1, 3, 3),
			array(1, 4, 3),
			array(1, 3, 4)
		);
		$this->_matrix = MatrixFactory::createFromArray(3, 3, $data);
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
		$data = array(
			array(1, 3, 3),
			array(1, 4, 3),
			array(1, 3, 4)
		);
		$matrix = MatrixFactory::createFromArray(3, 3, $data);
		
		$this->assertTrue($this->_matrix->isEqual($matrix));
	}
	
	/**
	 * @test
	 */
	public function oneSingleValueMakeMatrixDifferent() {
		$data = array(
			array(1, 3, 3),
			array(1, 1, 3),
			array(1, 3, 4)
		);
		$matrix = MatrixFactory::createFromArray(3, 3, $data);
		
		$this->assertFalse($this->_matrix->isEqual($matrix));
	}

	/**
	 * @test
	 */
	public function havingDifferentNumberOfRowsReturnsFalse() {
		$matrix = MatrixFactory::createWithInitialValue($this->_matrix->getSize(1) + 1, $this->_matrix->getSize(2), 2);
		
		$this->assertFalse($this->_matrix->isEqual($matrix));
		
	}
	
	/**
	 * @test
	 */
	public function havingDifferentNumberOfColumnsReturnsFalse() {
		$matrix = MatrixFactory::createWithInitialValue($this->_matrix->getSize(1), $this->_matrix->getSize(2) + 1, 2);
		
		$this->assertFalse($this->_matrix->isEqual($matrix));
		
	}
}