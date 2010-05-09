<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once dirname(__FILE__) . '/../classes/Matrix.class.php';

class EmptyMatrixTest extends PHPUnit_Framework_TestCase {
	private $_matrix = null;

	public function setUp() {
		$this->_matrix = new Matrix();
	}

	/**
	 * @test
	 */
	public function askingForSizeAlwaysReturnsFalse() {
		$this->assertFalse($this->_matrix->getSize(1));
		$this->assertFalse($this->_matrix->getSize(2));
	}
}