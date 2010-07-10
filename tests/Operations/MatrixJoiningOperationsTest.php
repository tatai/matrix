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
class MatrixJoiningOperationsTest extends PHPUnit_Framework_TestCase {
	private $_matrix = null;
	
	public function setup() {
		$left = array(
			array(2, 6, 1),
			array(4, 1, 3)
		);
		$this->_left = MatrixFactory::createFromArray(2, 3, $left);

		$right = array(
			array(8, 9, 10)
		);
		$this->_right = MatrixFactory::createFromArray(1, 3, $right);
	}

	/**
	 * @test
	 */
	public function joiningTwoCompatibleArrays() {
		$data = array(
			array(2, 6, 1),
			array(4, 1, 3),
			array(8, 9, 10)
		);
		$correct = MatrixFactory::createFromArray(3, 3, $data);
		
		$join = MatrixOperations::join($this->_left, $this->_right);
		
		$this->assertTrue($correct->isEqual($join));
	}
	
	/**
	 * @test
	 */
	public function joiningTwoIncompatibleArraysReturnsFalse() {
		$incompatible = MatrixFactory::createWithInitialValue(2, 2, 0);
		$join = MatrixOperations::join($this->_left, $incompatible);
		
		$this->assertFalse($join);
	}
}