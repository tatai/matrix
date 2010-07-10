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
class MultiplyByMatrixTest extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 */
	public function whenNumberOfColumnsInOneMatrixIsNotNumberOfRowsInTheOtherReturnsNull() {
		$matrix = MatrixFactory::createWithInitialValue(2, 5, 1);
		
		$this->assertNull(MatrixArithmetics::multiply($matrix, $matrix));
	}

	/**
	 * @test
	 */
	public function whenNumberOfRowsInOneMatrixIsNotNumberOfColumnsInTheOtherReturnsNull() {
		$matrix = MatrixFactory::createWithInitialValue(2, 5, 1);
		
		$this->assertNull(MatrixArithmetics::multiply($matrix, $matrix));
	}
	
	/**
	 * @test
	 */
	public function matrixAreMultipliedCorrectly() {
		$left = array(
			array(1, 2, 3),
			array(4, 5, 6)
		);
		$right = array(
			array(7, 2),
			array(11, 6),
			array(5, 9)
		);
		$correct = array(
			array(44, 41),
			array(113, 92)
		);
		
		$result = MatrixArithmetics::multiply(MatrixFactory::createFromArray(2, 3, $left), MatrixFactory::createFromArray(3, 2, $right));
		
		$this->assertTrue(MatrixFactory::createFromArray(2, 2, $correct)->isEqual($result));
	}
}