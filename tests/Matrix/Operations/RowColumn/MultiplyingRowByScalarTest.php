<?php
class MultiplyingRowByScalarTest extends PHPUnit_Framework_TestCase {
	/**
	 * 
	 * @var Matrix
	 */
	private $_matrix = null;
	
	/**
	 * 
	 * @var array
	 */
	private $_data = null;

	public function setUp() {
		$this->_data = array(
			array(1, 3, 3),
			array(1, 4, 3),
			array(1, 3, 4)
		);
		$this->_matrix = MatrixFactory::createFromArray(3, 3, $this->_data);
	}
	
	/**
	 * @test
	 */
	public function whenRowDoesNotExistsReturnsFalseAndMatrixIsNotChanged() {
		$original = clone $this->_matrix;
		
		$this->assertFalse(MatrixRowColumnOperations::multiplyRowBy($this->_matrix, count($this->_data), 10));
		$this->assertTrue($original->isEqual($this->_matrix));
	}
	
	/**
	 * @test
	 */
	public function ifEverythingWentFineReturnsTrue() {
		$this->assertTrue(MatrixRowColumnOperations::multiplyRowBy($this->_matrix, 1, 10));
	}

	/**
	 * @test
	 */
	public function multiplyRowByTwo() {
		$multiplyBy = 2;

		$result = $this->_data;
		for($i = 0; $i < count($result); $i++) {
			$result[$i][0] *= $multiplyBy;
		}

		MatrixRowColumnOperations::multiplyRowBy($this->_matrix, 0, $multiplyBy);
		
		$this->assertTrue(MatrixFactory::createFromArray(3, 3, $result)->isEqual($this->_matrix));
	}
}