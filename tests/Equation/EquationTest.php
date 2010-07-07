<?php
class EquationTest extends PHPUnit_Framework_TestCase {
	/**
	 * 
	 * @var Equation
	 */
	private $_equation = null;

	/**
	 * 
	 * @var array
	 */
	private $_coeffs = null;

	public function setUp() {
		$this->_coeffs = array(4, 3, 2, 1);
		$this->_equation = new Equation($this->_coeffs);
	}

	/**
	 * @test
	 */
	public function returnsDegree() {
		$this->assertEquals(3, $this->_equation->getDegree());
	}

	/**
	 * @test
	 */
	public function whenGivenPositiveVariableReturnsCorrectValue() {
		$this->assertEquals(142, $this->_equation->evaluate(3));
	}

	/**
	 * @test
	 */
	public function whenGivenNegativeVariableReturnsCorrectValue() {
		$this->assertEquals(-86, $this->_equation->evaluate(-3));
	}
	
	/**
	 * @test
	 */
	public function whenGivenZeroAsVaribleReturnIndependentCoeff() {
		$this->assertEquals(1, $this->_equation->evaluate(0));
	}
	
	/**
	 * @test
	 */
	public function coeffsAreStoredInInverseOrder() {
		$degree = $this->_equation->getDegree();
		foreach($this->_coeffs AS $i => $coeff) {
			$this->assertEquals($this->_coeffs[$degree - $i], $this->_equation->coeff($i));
		}
	}
}