<?php
class EmptyMatrixTest extends PHPUnit_Framework_TestCase {
	/**
	 * @test
	 */
	public function returnsValidDimensionSize() {
		$x = rand(1,10);
		$y = rand(1,10);
		$matrix = new Matrix($x, $y);

		$this->assertEquals($x, $matrix->getSize(1));
		$this->assertEquals($y, $matrix->getSize(2));
	}

	/**
	 * @test
	 */
	public function returnFalseWhenAskingForUnexistingDimensionSize() {
		$x = rand(1,10);
		$y = rand(1,10);
		$matrix = new Matrix(rand(1,10), rand(1,10));

		$this->assertFalse($matrix->getSize(3));
	}
}