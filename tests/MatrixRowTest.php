<?php
class MatrixRowTest extends PHPUnit_Framework_TestCase {
	private $_matrix = null;

	public function setUp() {
		$data = array(
			array(1, 3, 5),
			array(2, 4, 6)
		);
		$this->_matrix = MatrixFactory::createFromArray(2, 3, $data);
	}

	/**
	 * @test
	 */
	public function returnsMatrixRowCorrectly() {
		$row = $this->_matrix->getRow(1);
		$this->assertEquals(3, $row->current());
		$row->next();
		$this->assertEquals(4, $row->current());
	}

	/**
	 * @test
	 */
	public function returnsSizeCorrectly() {
		$row = $this->_matrix->getRow(1);
		$this->assertEquals(2, $row->size());
	}
}