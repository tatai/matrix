<?php
class MatrixFactory {

	private function __construct() {
	
	}

	static public function createWithInitialValue($x, $y, $value) {
		if(!is_numeric($value)) {
			return null;
		}
		
		return new Matrix($x, $y, $value);
	}

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