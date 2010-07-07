<?php
class UnknownRendererHtmlTest extends PHPUnit_Framework_TestCase {
	/**
	 * 
	 * @var UnknownRendererHtml
	 */
	private $_renderer = null;

	public function setUp() {
		$this->_renderer = new UnknownRendererHtml();
	}
	
	/**
	 * @test
	 */
	public function zeroDegreeReturnsEmptyString() {
		$this->assertEquals('', $this->_renderer->render(0));
	}
	
	/**
	 * @test
	 */
	public function firstDegreeReturnsOnlyUnknown() {
		$this->assertEquals('x', $this->_renderer->render(1));
	}
		
	/**
	 * @test
	 */
	public function secondDegreeReturnsUnknownAndDegreeWithSupTag() {
		$this->assertEquals('x<sup>2</sup>', $this->_renderer->render(2));
	}
}