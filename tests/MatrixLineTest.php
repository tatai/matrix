<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once dirname(__FILE__) . '/../classes/Matrix.class.php';
require_once dirname(__FILE__) . '/../classes/MatrixRow.class.php';
require_once dirname(__FILE__) . '/../classes/MatrixLine.class.php';

class MatrixLineTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var MatrixRow
	 */
	private $_row = null;
	
	private $_data = null;

	public function setUp() {
		$this->_data = array(1, 2, 3, 4, 5);
		$this->_row = new MatrixRow($this->_data);
	}

	/**
	 * @test
	 */
	public function comparingSameRowsGivesSameValueReturnsTrue() {
		$check = new MatrixRow($this->_data);
		$this->assertTrue($this->_row->isEqual($check));
	}

	/**
	 * @test
	 */
	public function comparingRowsOfDifferentSizeReturnsFalse() {
		$data = array(1, 2, 3);
		$check = new MatrixRow($data);
		$this->assertFalse($this->_row->isEqual($check));
	}

	/**
	 * @test
	 */
	public function comparingRowsOfSameSizeButDifferentValuesReturnsFalse() {
		$data = array(2, 3, 4, 5, 6);
		$check = new MatrixRow($data);
		$this->assertFalse($this->_row->isEqual($check));
	}
}