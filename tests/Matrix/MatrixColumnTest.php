<?php
class MatrixColumnTest extends PHPUnit_Framework_TestCase {
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
	public function returnsMatrixColumnCorrectly() {
		$column = $this->_matrix->getColumn(1);
		$this->assertEquals(2, $column->current());
		$column->next();
		$this->assertEquals(4, $column->current());
		$column->next();
		$this->assertEquals(6, $column->current());
	}
	
	/**
	 * @test
	 */
	public function returnsSizeCorrectly() {
		$column = $this->_matrix->getColumn(1);
		$this->assertEquals(3, $column->size());
	}
}