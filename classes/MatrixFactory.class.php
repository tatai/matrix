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
class MatrixFactory {

	private function __construct() {
	
	}

	/**
	 *
	 * @param $x int size of first dimension
	 * @param $y int size of second dimension
	 * @param $value float initial value
	 * @return Matrix
	 */
	static public function createWithInitialValue($x, $y, $value) {
		if(!is_numeric($value)) {
			return null;
		}
		
		return new Matrix($x, $y, $value);
	}

	/**
	 *
	 * @param $x int size of first dimension
	 * @param $y int size of second dimension
	 * @param $values array of data
	 * @param $value float value to use if there is not value in array
	 * @return Matrix
	 */
	static public function createFromArray($x, $y, $values, $fillValue = 0) {
		if(!is_array($values)) {
			return null;
		}
		
		$matrix = new Matrix($x, $y, $fillValue);
		
		for($i = 0; $i < $x; $i++) {
			if(isset($values[$i])) {
				$end = min(count($values[$i]), $y);
				for($j = 0; $j < $end; $j++) {
					$matrix->set($i, $j, $values[$i][$j]);
				}
			}
		}
		
		return $matrix;
	}

	/**
	 * 
	 * @param $size int size of the resulting matrix
	 * @return Matrix
	 */
	static public function identity($size) {
		$matrix = new Matrix($size, $size, 0);
		
		for($i = 0; $i < $size; $i++) {
			$matrix->set($i, $i, 1);
		}
		
		return $matrix;
	}

	static public function random($x, $y = null) {
		$sizeX = $x;
		if(is_null($y)) {
			$sizeY = $sizeX;
		}
		else {
			$sizeY = $y;
		}
		
		$matrix = new Matrix($sizeX, $sizeY, 0);
		
		for($i = 0; $i < $sizeX; $i++) {
			for($j = 0; $j < $sizeY; $j++) {
				$matrix->set($i, $j, rand(0, 100));
			}
		
		}
		
		return $matrix;
	}
}