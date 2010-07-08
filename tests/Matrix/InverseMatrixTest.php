<?php
class InverseMatrixTest extends PHPUnit_Framework_TestCase {
	/**
	 * @test
	 */
	public function givingNotSquareMatrixReturnsFalse() {
		$matrix = MatrixFactory::createWithInitialValue(2, 3, 4);

		$this->assertFalse(MatrixOperations::inverse($matrix));
	}

	/**
	 * @test
	 */
	public function doInverse3x3() {

		$matrix = MatrixFactory::createWithInitialValue(3, 3, 0);
		$matrix->set(0, 0, 1);
		$matrix->set(0, 1, 1);
		$matrix->set(0, 2, 1);
		$matrix->set(1, 0, 3);
		$matrix->set(1, 1, 4);
		$matrix->set(1, 2, 3);
		$matrix->set(2, 0, 3);
		$matrix->set(2, 1, 3);
		$matrix->set(2, 2, 4);
		
		$res = MatrixOperations::inverse($matrix);
		
		$shouldBe = MatrixFactory::createWithInitialValue(3, 3, 0);
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
		$matrix = MatrixFactory::createFromArray(2, 2, $values);
		
		$res = MatrixOperations::inverse($matrix);
		
		$values = array(
			array(-2, 1.5),
			array(1, -0.5)
		);
		$shouldBe = MatrixFactory::createFromArray(2, 2, $values);
		
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
		$matrix = MatrixFactory::createFromArray(6, 3, $data);
		*/
		$data = array(
			array(1, -1, 3),
			array(1, -2, -7),
			array(2, 3, 4),
			array(8, 1, 10)
		);
		$matrix = MatrixFactory::createFromArray(4, 3, $data);
		
		/*
		$expected = array(
			array(1, 0, 0),
			array(0, 1, 0),
			array(0, 0, 1),
			array(0.75, 0.5, 0.25),
			array(0.5, 1, 0.5),
			array(0.25, 0.5, 0.75)
		);
		$expectedMatrix = MatrixFactory::createFromArray(6, 3, $expected);		
		*/
		$expected = array(
			array(1, 0, 0),
			array(0, 1, 0),
			array(0, 0, 1),
			array(3, 1, 2)
		);
		$expectedMatrix = MatrixFactory::createFromArray(4, 3, $expected);		
		
		$resultFromGJE = MatrixOperations::gaussJordanElimination($matrix);
		
		$this->assertTrue($expectedMatrix->isEqual($resultFromGJE));
	}
}