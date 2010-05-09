<?php
class Matrix {
	private $_dims = null;
	private $_data = null;

	public function __construct() {
	}

	public function initWithValue($x, $y, $value = null) {
		$this->_dims = array($x, $y);
		$this->_initEmptyArray($x, $y, $value);
	}

	private function _initEmptyArray($x, $y, $value) {
		$row = array_fill(0, $y, $value);
		for($i = 0; $i < $x; $i++) {
			$this->_data[] = $row;
		}
	}

	public function getSize($dim) {
		if(count($this->_dims) < $dim) {
			return false;
		}
		
		return $this->_dims[$dim - 1];
	}

	/**
	 * Returns value in defined cell. If either $x or $y is outside matrix
	 * boundaries, it returns false 
	 *
	 * @paran $x int position in first dimension
	 * @paran $y int position in second dimension
	 * @return mixed value in cell, false on error
	 */
	public function get($x, $y) {
		if(!$this->_checkValidPosition($x, $y)) {
			return false;
		}
		
		return $this->_data[$x][$y];
	}

	/**
	 * Assigns given value to cell
	 * 
	 * @paran $x int position in first dimension
	 * @paran $y int position in second dimension
	 * @return bool true if value is assigned correctly, false otherwise
	 */
	public function set($x, $y, $value) {
		if(!$this->_checkValidPosition($x, $y)) {
			return false;
		}
		
		$this->_data[$x][$y] = $value;
		
		return true;
	}

	private function _checkValidPosition($x, $y) {
		return ($this->_dims[0] > $x || $this->_dims[1] > $y);
	}
}