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
class CreatingRandomMatrixTest extends PHPUnit_Framework_TestCase {
	/**
	 * @test
	 */
	public function matrixSizeIsCorrect() {
		$matrix = MatrixFactory::random(3, 2);

		$this->assertEquals(3, $matrix->getSize(1));
		$this->assertEquals(2, $matrix->getSize(2));
	}
	
	/**
	 * @test
	 */
	public function ifOnlyXSizeGivenThenMatrixIsSquare() {
		$matrix = MatrixFactory::random(3);

		$this->assertEquals(3, $matrix->getSize(1));
		$this->assertEquals(3, $matrix->getSize(2));
	}
	
	/**
	 * @test
	 */
	public function twoRandomMatrixOfSameSizeAreNotEqual() {
		$matrix1 = MatrixFactory::random(3);
		$matrix2 = MatrixFactory::random(3);
		
		$this->assertFalse($matrix1->isEqual($matrix2));
	}
}