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
class MatrixOperations {
	private function __construct() {
	}

	static public function inverse(Matrix $matrix) {
		if($matrix->getSize(1) != $matrix->getSize(2)) {
			return false;
		}
		
		$workingCopy = clone $matrix;
		
		$identity = MatrixFactory::identity($matrix->getSize(1));
		
		for($i = 0; $i < $matrix->getSize(1); $i++) {
			self::_reduceColumn($i, $workingCopy, $identity);
		}
		
		return $identity;
	}

	/**
	 * Joins to matrix of compatible sizes (having same second dimension size).
	 * Joining is done basically putting together both matrix (A: nxm and B: pxm)
	 * in a resulting array C: (n+p)xm  
	 *
	 * @param $left Matrix
	 * @param $right Matrix
	 * @return Matrix if everything goes ok, false otherwise
	 */
	static public function join(Matrix $left, Matrix $right) {
		if($left->getSize(2) != $right->getSize(2)) {
			return false;
		}
		
		$newSize = $left->getSize(1) + $right->getSize(1);
		
		$matrix = MatrixFactory::createWithInitialValue($newSize, $left->getSize(2), 0);
		
		for($i = 0; $i < $left->getSize(1); $i++) {
			for($j = 0; $j < $left->getSize(2); $j++) {
				$matrix->set($i, $j, $left->get($i, $j));
			}
		}
		for($i = 0; $i < $right->getSize(1); $i++) {
			for($j = 0; $j < $right->getSize(2); $j++) {
				$matrix->set($i + $left->getSize(1), $j, $right->get($i, $j));
			}
		}
		
		return $matrix;
	}

	static public function gaussJordanElimination(Matrix $matrix) {
		$workingCopy = clone $matrix;
		for($i = 0; $i < $matrix->getSize(2); $i++) {
			self::_reduceColumn($i, $workingCopy);
		}
		
		return $workingCopy;
	}
	
	private function _reduceColumn($column, Matrix $matrix, Matrix $identity = null) {
		$baseValue = $matrix->get($column, $column);
		$ratio = 1 / $baseValue;
		
		MatrixRowColumnOperations::multiplyRowBy($matrix, $column, $ratio);
		if(!is_null($identity)) {
			MatrixRowColumnOperations::multiplyRowBy($identity, $column, $ratio);
		}
		
		for($i = 0; $i < $matrix->getSize(2); $i++) {
			if($i == $column) {
				continue;
			}
			
			$value = $matrix->get($column, $i);
			
			for($j = 0; $j < $matrix->getSize(1); $j++) {
				$matrix->set($j, $i, $matrix->get($j, $i) - $matrix->get($j, $column) * $value);
				if(!is_null($identity)) {
					$identity->set($j, $i, $identity->get($j, $i) - $identity->get($j, $column) * $value);
				}
			}
		}
	}

	static public function transpose(Matrix $matrix) {
		$traspose = MatrixFactory::createWithInitialValue($matrix->getSize(2), $matrix->getSize(1), 0);
		
		for($i = 0; $i < $matrix->getSize(1); $i++) {
			for($j = 0; $j < $matrix->getSize(2); $j++) {
				$traspose->set($j, $i, $matrix->get($i, $j));
			}
		}
				
		return $traspose;
	}
}