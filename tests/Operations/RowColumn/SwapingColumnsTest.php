<?php
/* 
 * Matrix http://www.tatai.es
 * Copyright (C) 2010 Francisco José Naranjo <fran.naranjo@gmail.com>
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 * 
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
class SwapingColumnsTest extends PHPUnit_Framework_TestCase {
	/**
	 * 
	 * @var Matrix
	 */
	private $_matrix = null;
	
	/**
	 * 
	 * @var array
	 */
	private $_matrix_data = null;
	
	public function setup() {
		$this->_matrix_data = array(
			array(1, 3, 5),
			array(2, 4, 6)
		);
		$this->_matrix = MatrixFactory::createFromArray(2, 3, $this->_matrix_data);
	}

	/**
	 * @test
	 */
	public function whenFirstColumnDoesNotExistsReturnsSameMatrix() {
		$test = clone $this->_matrix;
		MatrixRowColumnOperations::swapRows($test, 4, 1);
		
		$this->assertTrue($this->_matrix->isEqual($test));
	}

	/**
	 * @test
	 */
	public function whenSecondColumnDoesNotExistsReturnsSameMatrix() {
		$test = clone $this->_matrix;
		MatrixRowColumnOperations::swapRows($test, 1, 4);
		
		$this->assertTrue($this->_matrix->isEqual($test));
	}

	/**
	 * @test
	 */
	public function swapingTwoColumns() {
		$shouldBeData = array(
			array(2, 4, 6),
			array(1, 3, 5)
			);
		$shouldBe = MatrixFactory::createFromArray(2, 3, $shouldBeData);
		
		MatrixRowColumnOperations::swapColumns($this->_matrix, 0, 1);
		
		$this->assertTrue($this->_matrix->isEqual($shouldBe));
	}
}