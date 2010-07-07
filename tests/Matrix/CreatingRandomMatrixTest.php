<?php
class CreatingRandomMatrixTest extends PHPUnit_Framework_TestCase {
	/**
	 * @test
	 */
	public function matrixSizeIsCorrect() {
		$matrix = MatrixFactory::random(3, 2);

		$this->assertEquals(3, $matrix->getSize(1));
		$this->assertEquals(2, $matrix->getSize(2));
	}
	
	/**
	 * @test
	 */
	public function ifOnlyXSizeGivenThenMatrixIsSquare() {
		$matrix = MatrixFactory::random(3);

		$this->assertEquals(3, $matrix->getSize(1));
		$this->assertEquals(3, $matrix->getSize(2));
	}
	
	/**
	 * @test
	 */
	public function twoRandomMatrixOfSameSizeAreNotEqual() {
		$matrix1 = MatrixFactory::random(3);
		$matrix2 = MatrixFactory::random(3);
		
		$this->assertFalse($matrix1->isEqual($matrix2));
	}
}