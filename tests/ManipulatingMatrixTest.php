<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once dirname(__FILE__) . '/../classes/Matrix.class.php';

class ManipulatingMatrix extends PHPUnit_Framework_TestCase {
	/**
	 * 
	 * @var Matrix
	 */
	private $_matrix = null;

	public function setUp() {
		$this->_matrix = new Matrix();
	}

	/**
	 * @test
	 */
	public function swapingTwoRows() {
		$data = array(
			array(1, 3, 5),
			array(2, 4, 6)
		);
		$this->_matrix->initFromArray(2, 3, $data);
		
		$shouldBeData = array(
			array(3, 1, 5),
			array(4, 2, 6)
		);
		$shouldBe = new Matrix();
		$shouldBe->initFromArray(2, 3, $shouldBeData);
		
		$this->_matrix->swapRows(0, 1);
		
		$this->assertTrue($this->_matrix->isEqual($shouldBe));
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
		$this->_matrix->initFromArray(3, 2, $data);
		
		$shouldBeData = array(
			array(2, 5),
			array(1, 4),
			array(3, 6)
				);
		$shouldBe = new Matrix();
		$shouldBe->initFromArray(3, 2, $shouldBeData);
		
		$this->_matrix->swapColumns(0, 1);
		
		$this->assertTrue($this->_matrix->isEqual($shouldBe));
	}
}