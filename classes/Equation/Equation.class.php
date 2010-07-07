<?php
class Equation {
	private $_coeffs = null;

	public function __construct(Array $coeffs) {
		$this->_coeffs = $coeffs;
	}
	
	public function getDegree() {
		return count($this->_coeffs) - 1;
	}
	
	public function evaluate($x) {
		$value = (float)$x;

		// Effient when 0 given
		if($value == 0) {
			return $this->_coeffs[$this->getDegree()];
		}

		$result = 0;
		foreach($this->_coeffs AS $coeff) {
			$result = $result * $value + $coeff;
		}
		
		return $result;
	}

	public function coeff($degree) {
		return $this->_coeffs[$this->getDegree() - $degree];
	}
}
