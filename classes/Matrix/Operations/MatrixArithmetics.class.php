<?php
class MatrixArithmetics {

	private function __construct() {
	
	}

	static public function sum(Matrix $left, Matrix $right) {
		if(!self::_checkMatrixSameSize($left, $right)) {
			return false;
		}
		
		$x = $left->getSize(1);
		$y = $left->getSize(2);
		$matrix = MatrixFactory::createWithInitialValue($x, $y, 0);
		
		for($i = 0; $i < $x; $i++) {
			for($j = 0; $j < $y; $j++) {
				$matrix->set($i, $j, $left->get($i, $j) + $right->get($i, $j));
			}
		}
		
		return $matrix;
	}

	static public function substract(Matrix $left, Matrix $right) {
		if(!self::_checkMatrixSameSize($left, $right)) {
			return false;
		}
		
		$x = $left->getSize(1);
		$y = $left->getSize(2);
		$matrix = MatrixFactory::createWithInitialValue($x, $y, 0);
		
		for($i = 0; $i < $x; $i++) {
			for($j = 0; $j < $y; $j++) {
				$matrix->set($i, $j, $left->get($i, $j) - $right->get($i, $j));
			}
		}
		
		return $matrix;
	}

	static public function multiply(Matrix $matrix, $value) {
		if(is_numeric($value)) {
			return self::_multiplyByScalar($matrix, $value);
		}
		else if($value instanceof Matrix) {
			return self::_multiplyByMatrix($matrix, $value);
		}
		
		return null;
	}

	private function _multiplyByScalar(Matrix $matrix, $value) {
		$result = clone $matrix;
		
		$x = $result->getSize(1);
		$y = $result->getSize(2);
		
		for($i = 0; $i < $x; $i++) {
			for($j = 0; $j < $y; $j++) {
				$result->set($i, $j, $result->get($i, $j) * $value);
			}
		}
		
		return $result;
	}

	private function _multiplyByMatrix(Matrix $left, Matrix $right) {
		if($left->getSize(1) != $right->getSize(2) || $left->getSize(2) != $right->getSize(1)) {
			return null;
		}
		
		$result = MatrixFactory::createWithInitialValue($left->getSize(1), $right->getSize(2), 0);
		
		for($i = 0; $i < $left->getSize(1); $i++) {
			for($j = 0; $j < $right->getSize(2); $j++) {
				$sum = 0;
				for($k = 0; $k < $left->getSize(2); $k++) {
					$sum += $left->get($i, $k) * $right->get($k, $j);
				}
				$result->set($i, $j, $sum);
			}
		
		}
		
		return $result;
	}

	private function _checkMatrixSameSize(Matrix $left, Matrix $right) {
		if($left->getSize(1) != $right->getSize(1) || $left->getSize(2) != $right->getSize(2)) {
			return false;
		}
		
		return true;
	}
}