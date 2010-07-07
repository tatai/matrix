<?php
class MultiplyByScalarTest extends PHPUnit_Framework_TestCase {
	/**
	 * @test
	 */
	public function resultingMatrixHasSameSize() {
		$matrix = MatrixFactory::random(2, 4);
		
		$result = MatrixArithmetics::multiply($matrix, 3);

		$this->assertEquals(2, $result->getSize(1));
		$this->assertEquals(4, $result->getSize(2));
	}
	
	/**
	 * @test
	 */
	public function allValuesAreMultiplied() {
		$multiplyBy = 5;
		$matrix = array(
			array(rand(0, 100), rand(0, 100)),
			array(rand(0, 100), rand(0, 100)),
			array(rand(0, 100), rand(0, 100))
			);
		
		$result = MatrixArithmetics::multiply(MatrixFactory::createFromArray(2, 3, $matrix), $multiplyBy);
		
		for($i = 0; $i < 2; $i++) {
			for($j = 0; $j < 3; $j++) {
				$this->assertEquals($matrix[$i][$j] * $multiplyBy, $result->get($i, $j));
			}
		}
	}
}