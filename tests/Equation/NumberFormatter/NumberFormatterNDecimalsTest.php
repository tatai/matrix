<?php
class NumberFormatterNDecimalsTest extends PHPUnit_Framework_TestCase {
	/**
	 * 
	 * @var NumberFormatterNDecimals
	 */
	private $_formatter = null;

	public function setUp() {
		$this->_formatter = new NumberFormatterNDecimals(4);
	}
	
	/**
	 * @test
	 */
	public function padsDecimals() {
		$this->assertEquals('0.0324', (string)$this->_formatter->format('0.032423'));
	}
	
	/**
	 * @test
	 */
	public function doNotUseThousandsSeparator() {
		$this->assertEquals('12340.0324', (string)$this->_formatter->format('12340.032423'));
	}
}