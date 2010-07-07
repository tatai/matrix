<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once dirname(__FILE__) . '/../classes/Matrix.class.php';

class ManipulatingMatrix extends PHPUnit_Framework_TestCase {
	/**
	 * @test
	 */
	public function swapingTwoRows() {
		$data = array(
			array(1, 3, 5),
			array(2, 4, 6)
		);
		$matrix = MatrixFactory::createFromArray(2, 3, $data);
		
		$shouldBeData = array(
			array(3, 1, 5),
			array(4, 2, 6)
		);
		$shouldBe = MatrixFactory::createFromArray(2, 3, $shouldBeData);
		
		$operations = new MatrixRowColumnOperations();
		$operations->swapRows($matrix, 0, 1);
		
		$this->assertTrue($matrix->isEqual($shouldBe));
	}

	/**
	 * @test
	 */
	public function swapingTwoColumns() {
		$data = array(
			array(1, 4),
			array(2, 5),
			array(3, 6)
		);
		$matrix = MatrixFactory::createFromArray(3, 2, $data);
		
		$shouldBeData = array(
			array(2, 5),
			array(1, 4),
			array(3, 6)
				);
		$shouldBe = MatrixFactory::createFromArray(3, 2, $shouldBeData);

		$operations = new MatrixRowColumnOperations();
		$operations->swapColumns($matrix, 0, 1);
		
		$this->assertTrue($matrix->isEqual($shouldBe));
	}
}