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
class SumOfTwoMatrixTest extends PHPUnit_Framework_TestCase {
	/**
	 * @test
	 */
	public function whenHavingDifferentSizeCannotBeSummed() {
		$matrix1 = MatrixFactory::random(3);
		$matrix2 = MatrixFactory::random(2);
		
		$this->assertFalse(MatrixArithmetics::sum($matrix1, $matrix2));
	}
	
	/**
	 * @test
	 */
	public function resultingMatrixHasSameSize() {
		$matrix1 = MatrixFactory::random(2, 4);
		$matrix2 = MatrixFactory::random(2, 4);
		
		$result = MatrixArithmetics::sum($matrix1, $matrix2);

		$this->assertEquals(2, $result->getSize(1));
		$this->assertEquals(4, $result->getSize(2));
	}
	
	/**
	 * @test
	 */
	public function sumIsMadeValueByValue() {
		$left = array(
			array(rand(0, 100), rand(0, 100)),
			array(rand(0, 100), rand(0, 100))
		);
		$right = array(
			array(rand(0, 100), rand(0, 100)),
			array(rand(0, 100), rand(0, 100))
		);
		
		$result = MatrixArithmetics::sum(MatrixFactory::createFromArray(2, 2, $left), MatrixFactory::createFromArray(2, 2, $right));
		
		for($i = 0; $i < 2; $i++) {
			for($j = 0; $j < 2; $j++) {
				$this->assertEquals($left[$i][$j] + $right[$i][$j], $result->get($i, $j));
			}
		}
	}
}