<?php
class MultiplyByMatrixTest extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 */
	public function whenNumberOfColumnsInOneMatrixIsNotNumberOfRowsInTheOtherReturnsNull() {
		$matrix = MatrixFactory::createWithInitialValue(2, 5, 1);
		
		$this->assertNull(MatrixArithmetics::multiply($matrix, $matrix));
	}

	/**
	 * @test
	 */
	public function whenNumberOfRowsInOneMatrixIsNotNumberOfColumnsInTheOtherReturnsNull() {
		$matrix = MatrixFactory::createWithInitialValue(2, 5, 1);
		
		$this->assertNull(MatrixArithmetics::multiply($matrix, $matrix));
	}
	
	/**
	 * @test
	 */
	public function matrixAreMultipliedCorrectly() {
		$left = array(
			array(1, 2, 3),
			array(4, 5, 6)
		);
		$right = array(
			array(7, 2),
			array(11, 6),
			array(5, 9)
		);
		$correct = array(
			array(44, 41),
			array(113, 92)
		);
		
		$result = MatrixArithmetics::multiply(MatrixFactory::createFromArray(2, 3, $left), MatrixFactory::createFromArray(3, 2, $right));
		
		$this->assertTrue(MatrixFactory::createFromArray(2, 2, $correct)->isEqual($result));
	}
}