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
}