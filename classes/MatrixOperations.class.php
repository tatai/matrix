<?php
class MatrixOperations {

	public function __construct() {
	
	}

	public function inverse(Matrix $matrix) {
		if($matrix->getSize(1) != $matrix->getSize(2)) {
			return false;
		}
		
		$workingCopy = clone $matrix;
		
		$identity = $this->_createIdentity($matrix->getSize(1));
		
		for($i = 0; $i < $matrix->getSize(1); $i++) {
			$this->_reduceColumn($i, $workingCopy, $identity);
		}
		
		return $identity;
	}

	private function _reduceColumn($column, Matrix $matrix, Matrix $identity = null) {
		$baseValue = $matrix->get($column, $column);
		$ratio = 1 / $baseValue;
		
		$matrix->multiplyRowBy($column, $ratio);
		if(!is_null($identity)) {
			$identity->multiplyRowBy($column, $ratio);
		}
		
		for($i = 0; $i < $matrix->getSize(2); $i++) {
			if($i == $column) {
				continue;
			}
			
			$value = $matrix->get($column, $i);
			
			for($j = 0; $j < $matrix->getSize(1); $j++) {
				//print $j . ' - ' . $i . ' -> ' . $column . ' - ' . $i . "\n";
				$matrix->set($j, $i, $matrix->get($j, $i) - $matrix->get($j, $column) * $value);
				if(!is_null($identity)) {
					$identity->set($j, $i, $identity->get($j, $i) - $identity->get($j, $column) * $value);
				}
			}
			/*
		print 'parcial: ';
		$matrix->debug();
		if(!is_null($identity)) {
			$identity->debug();
		}
		*/
		
		}
	}

	private function _createIdentity($size) {
		$matrix = new Matrix();
		$matrix->initWithValue($size, $size, 0);
		
		for($i = 0; $i < $size; $i++) {
			$matrix->set($i, $i, 1);
		}
		
		return $matrix;
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
	public function join(Matrix $left, Matrix $right) {
		if($left->getSize(2) != $right->getSize(2)) {
			return false;
		}
		
		$newSize = $left->getSize(1) + $right->getSize(1);
		
		$matrix = new Matrix();
		$matrix->initWithValue($newSize, $left->getSize(2), 0);
		
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

	public function gaussJordanElimination(Matrix $matrix) {
		$workingCopy = clone $matrix;
		for($i = 0; $i < $matrix->getSize(2); $i++) {
			$this->_reduceColumn($i, $workingCopy);
		}
		
		return $workingCopy;
	}
}