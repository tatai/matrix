<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once dirname(__FILE__) . '/../classes/Matrix.class.php';

class CreatingMatrixFromArray extends PHPUnit_Framework_TestCase {
	/**
	 * 
	 * @var Matrix
	 */
	private $_matrix = null;
	private $_data = null;

	public function setUp() {
		$this->_matrix = new Matrix();
	}

	/**
	 * @test
	 */
	public function whenCreatingACorrectArrayThatFitsReturnsSameData() {
		$x = 4;
		$y = 3;
		
		$data = array();
		for($i = 0; $i < $x; $i++) {
			for($j = 0; $j < $y; $j++) {
				$data[$i][$j] = rand(0, 50);
			}
		}
		$this->_matrix->initFromArray($x, $y, $data);
		
		$this->assertEquals($x, $this->_matrix->getSize(1));
		$this->assertEquals($y, $this->_matrix->getSize(2));
		$this->assertTrue($this->_checkMatrixValues($x, $y, $this->_matrix, $data));
	}

	/**
	 * @test
	 */
	public function whenCreatingAMatrixFromBiggerArrayReturnsClippedData() {
		$x = 4;
		$y = 3;
		$toMatrixX = 2;
		$toMatrixY = 2;
		
		$data = array();
		for($i = 0; $i < $x; $i++) {
			for($j = 0; $j < $y; $j++) {
				$data[$i][$j] = rand(0, 50);
			}
		}
		$this->_matrix->initFromArray($toMatrixX, $toMatrixY, $data);
		
		$this->assertEquals($toMatrixX, $this->_matrix->getSize(1));
		$this->assertEquals($toMatrixY, $this->_matrix->getSize(2));
		$this->assertTrue($this->_checkMatrixValues($toMatrixX, $toMatrixY, $this->_matrix, $data));
	}

	/**
	 * @test
	 */
	public function whenCreatingAMatrixFromSmallertArrayReturnsDataWithFillingValue() {
		$x = 2;
		$y = 2;
		$toMatrixX = 3;
		$toMatrixY = 3;
		
		$data = array();
		for($i = 0; $i < $x; $i++) {
			for($j = 0; $j < $y; $j++) {
				$data[$i][$j] = rand(0, 50);
			}
		}
		$this->_matrix->initFromArray($toMatrixX, $toMatrixY, $data, 100);
		
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