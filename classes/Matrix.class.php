<?php
/* 
 * Matrix http://www.tatai.es
 * Copyright (C) 2010 Francisco José Naranjo <fran.naranjo@gmail.com>
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 * 
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
class Matrix {
	private $_dims = null;
	private $_data = null;

	public function __construct($x, $y, $fillValue = null) {
		$this->_dims = array($x, $y);
		$this->_initWithValue($fillValue);
	}

	private function _initWithValue($value = null) {
		$x = $this->getSize(1);
		$y = $this->getSize(2);

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
	}

	/**
	 * 
	 *
	 * @param $index integer row index (starting at 0)
	 * @return MatrixRow
	 */
	public function getRow($index) {
		include_once(dirname(__FILE__) . '/MatrixRow.class.php');
		$size = $this->getSize(1);
		
		$row = array();
		for($i = 0; $i < $size; $i++) {
			$row[] = $this->_data[$i][$index];
		}

		return new MatrixRow($row);
	}

	/**
	 * 
	 *
	 * @param $index integer row index (starting at 0)
	 * @return MatrixRow
	 */
	public function getColumn($index) {
		include_once(dirname(__FILE__) . '/MatrixColumn.class.php');
		return new MatrixColumn($this->_data[$index]);
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