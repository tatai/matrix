<?php
class CreatingMatrixFromArray extends PHPUnit_Framework_TestCase {
	/**
	 * 
	 * @var Matrix
	 */
	private $_matrix = null;
	private $_data = null;
	private $_xSize = null;
	private $_ySize = null;

	public function setUp() {
		$this->_xSize = 4;
		$this->_ySize = 3;
		
		$this->_data = $this->_generateData($this->_xSize, $this->_ySize);
	}

	private function _generateData($x, $y) {
		$data = array();
		for($i = 0; $i < $x; $i++) {
			for($j = 0; $j < $y; $j++) {
				$data[$i][$j] = rand(0, 50);
			}
		}
		
		return $data;
	}
	
	/**
	 * @test
	 */
	public function ifNotArrayTypeGivenReturnsNull() {
		$this->assertNull(MatrixFactory::createFromArray(1, 1, 3));
	}

	/**
	 * @test
	 */
	public function whenCreatingACorrectArrayReturnsSize() {
		$this->_matrix = MatrixFactory::createFromArray($this->_xSize, $this->_ySize, $this->_data);

		$this->assertEquals($this->_xSize, $this->_matrix->getSize(1));
		$this->assertEquals($this->_ySize, $this->_matrix->getSize(2));
	}

	/**
	 * @test
	 */
	public function whenCreatingACorrectArrayThatFitsReturnsSameData() {
		$this->_matrix = MatrixFactory::createFromArray($this->_xSize, $this->_ySize, $this->_data);

		$this->assertTrue($this->_checkMatrixValues($this->_xSize, $this->_ySize, $this->_matrix, $this->_data));
	}

	/**
	 * @test
	 */
	public function whenCreatingAMatrixFromBiggerArrayReturnsClippedData() {
		$toMatrixX = 2;
		$toMatrixY = 2;
		
		$this->_matrix = MatrixFactory::createFromArray($toMatrixX, $toMatrixY, $this->_data);

		$this->assertEquals($toMatrixX, $this->_matrix->getSize(1));
		$this->assertEquals($toMatrixY, $this->_matrix->getSize(2));
		$this->assertTrue($this->_checkMatrixValues($toMatrixX, $toMatrixY, $this->_matrix, $this->_data));
	}

	/**
	 * @test
	 */
	public function whenCreatingAMatrixFromSmallertArrayReturnsDataWithFillingValue() {
		$x = 2;
		$y = 2;
		$toMatrixX = 3;
		$toMatrixY = 3;
		
		$data = $this->_generateData($x, $y);
		$this->_matrix = MatrixFactory::createFromArray($toMatrixX, $toMatrixY, $data, 100);
		
		$check = $this->_checkMatrixValues($x, $y, $this->_matrix, $data);
		$check = $check && ($this->_matrix->get(2, 0) == 100);
		$check = $check && ($this->_matrix->get(2, 1) == 100);
		$check = $check && ($this->_matrix->get(2, 2) == 100);
		$check = $check && ($this->_matrix->get(1, 2) == 100);
		$check = $check && ($this->_matrix->get(0, 2) == 100);
		
		$this->assertEquals($toMatrixX, $this->_matrix->getSize(1));
		$this->assertEquals($toMatrixY, $this->_matrix->getSize(2));
		$this->assertTrue($check);
	}

	private function _checkMatrixValues($x, $y, Matrix $matrix, $data) {
		for($i = 0; $i < $x; $i++) {
			for($j = 0; $j < $y; $j++) {
				if($this->_matrix->get($i, $j) != $data[$i][$j]) {
					return false;
				}
			}
		}
		
		return true;
	}
}