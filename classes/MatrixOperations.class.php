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
			$this->_reduceColumn($workingCopy, $identity, $i);
		}
		
		return $identity;
	}

	private function _reduceColumn(Matrix $matrix, Matrix $identity, $column) {
		$baseValue = $matrix->get($column, $column);
		$ratio = 1 / $baseValue;
		
		$matrix->multiplyRowBy($column, $ratio);
		$identity->multiplyRowBy($column, $ratio);
		
		for($i = 0; $i < $matrix->getSize(2); $i++) {
			if($i == $column) {
				continue;
			}

			$value = $matrix->get($i, $column);
			
			for($j = 0; $j < $matrix->getSize(1); $j++) {
				$matrix->set($i, $j, $matrix->get($i, $j) - $matrix->get($column, $j) * $value);
				$identity->set($i, $j, $identity->get($i, $j) - $identity->get($column, $j) * $value);
			}
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
}