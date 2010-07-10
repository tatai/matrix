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
class MultiplyByScalarTest extends PHPUnit_Framework_TestCase {
	/**
	 * @test
	 */
	public function resultingMatrixHasSameSize() {
		$matrix = MatrixFactory::random(2, 4);
		
		$result = MatrixArithmetics::multiply($matrix, 3);

		$this->assertEquals(2, $result->getSize(1));
		$this->assertEquals(4, $result->getSize(2));
	}
	
	/**
	 * @test
	 */
	public function allValuesAreMultiplied() {
		$multiplyBy = 5;
		$matrix = array(
			array(rand(0, 100), rand(0, 100)),
			array(rand(0, 100), rand(0, 100)),
			array(rand(0, 100), rand(0, 100))
			);
		
		$result = MatrixArithmetics::multiply(MatrixFactory::createFromArray(2, 3, $matrix), $multiplyBy);
		
		for($i = 0; $i < 2; $i++) {
			for($j = 0; $j < 3; $j++) {
				$this->assertEquals($matrix[$i][$j] * $multiplyBy, $result->get($i, $j));
			}
		}
	}
}