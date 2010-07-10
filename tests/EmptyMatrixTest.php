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
class EmptyMatrixTest extends PHPUnit_Framework_TestCase {
	/**
	 * @test
	 */
	public function returnsValidDimensionSize() {
		$x = rand(1,10);
		$y = rand(1,10);
		$matrix = new Matrix($x, $y);

		$this->assertEquals($x, $matrix->getSize(1));
		$this->assertEquals($y, $matrix->getSize(2));
	}

	/**
	 * @test
	 */
	public function returnFalseWhenAskingForUnexistingDimensionSize() {
		$x = rand(1,10);
		$y = rand(1,10);
		$matrix = new Matrix(rand(1,10), rand(1,10));

		$this->assertFalse($matrix->getSize(3));
	}
}