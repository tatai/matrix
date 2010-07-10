<?php
class CreatingIdentityMatrixTest extends PHPUnit_Framework_TestCase {
	/**
	 * 
	 * @var Matrix
	 */
	private $_matrix = null;
	
	/**
	 * 
	 * @var integer
	 */
	private $_size = null;

	public function setup() {
		$this->_size = 4;
		$this->_matrix = MatrixFactory::identity($this->_size);
	}

	/**
	 * @test
	 */
	public function matrixIsSquare() {
		$this->assertEquals($this->_size, $this->_matrix->getSize(1));
		$this->assertEquals($this->_size, $this->_matrix->getSize(2));
	}
	
	/**
	 * @test
	 */
	public function matrixHasOnesInDiagonal() {
		$ones = true;
		for($i = 0; $i < $this->_size; $i++) {
			if($this->_matrix->get($i, $i) != 1) {
				$ones = false;
				break;
			}
		}
		
		$this->assertTrue($ones);
	}
	
	/**
	 * @test
	 */
	public function matrixHasZerosOutOfDiagonal() {
		$zeros = true;
		for($i = 0; $i < $this->_size; $i++) {
			for($j = 0; $j < $this->_size; $j++) {
				if($i != $j && $this->_matrix->get($i, $j) != 0) {
					$zeros = false;
					break;
				}
			}
		}
		
		$this->assertTrue($zeros);
	}
}