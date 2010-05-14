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

	public function initFromArray($x, $y, $values, $fillValue = 0) {
		$this->_dims = array($x, $y);
		for($i = 0; $i < $x; $i++) {
			if(!isset($values[$i])) {
				// Todo $fillValue
				$this->_data[$i] = array_fill(0, $y, $fillValue);
			}
			else if(count($values[$i]) < $y) {
				// Completamos con $fillValue
				$this->_data[$i] = array_merge($values[$i], array_fill(0, $y - count($values[$y]), $fillValue));
			}
			else if(count($values[$i]) >= $y) {
				$this->_data[$i] = array_slice($values[$i], 0, $y);
			}
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

	public function returnAsArray() {
		return $this->_data;
	}

	public function isEqual(Matrix $matrix) {
		if($this->getSize(1) != $matrix->getSize(1)) {
			return false;
		}
		
		if($this->getSize(2) != $matrix->getSize(2)) {
			return false;
		}
		
		$factor = 1.0000001;
		
		for($i = 0; $i < $this->getSize(1); $i++) {
			for($j = 0; $j < $this->getSize(1); $j++) {
				$base = $this->get($i, $j);
				if($base >= 0) {
					if($base * $factor < $matrix->get($i, $j) || $base / $factor > $matrix->get($i, $j)) {
						return false;
					}
				}
				if($base < 0) {
					if($base * $factor > $matrix->get($i, $j) || $base / $factor < $matrix->get($i, $j)) {
						return false;
					}
				}
			}
		}
		
		return true;
		return (strcmp(serialize($this->returnAsArray()), serialize($matrix->returnAsArray())) == 0);
	}

	public function multiplyRowBy($row, $value) {
		for($i = 0; $i < $this->getSize(1); $i++) {
			$this->_data[$i][$row] *= $value;
		}
	}

	public function multiplyColumnBy($column, $value) {
		for($i = 0; $i < $this->getSize(2); $i++) {
			$this->_data[$column][$i] *= $value;
		}
	}

	public function substractRow($targetRow, $fromRow) {
		for($i = 0; $i < $this->getSize(1); $i++) {
			$this->_data[$i][$targetRow] -= $this->_data[$fromRow][$i];
		}
	}

	public function debug() {
		for($j = 0; $j < $this->getSize(2); $j++) {
			$row = array();
			for($i = 0; $i < $this->getSize(1); $i++) {
				$row[] = $this->_data[$i][$j];
			}
			
			print implode(' ', $row) . "\n";
		}
		print "\n";
	}
}