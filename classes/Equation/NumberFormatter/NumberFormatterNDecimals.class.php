<?php
class NumberFormatterNDecimals implements INumberFormatter {
	private $_decimals = null;

	public function __construct($decimals) {
		$this->_decimals = $decimals;
	}

	public function format($value) {
		return number_format($value, $this->_decimals, '.', '');
	}
}