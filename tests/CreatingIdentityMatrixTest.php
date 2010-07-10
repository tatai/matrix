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
class CreatingIdentityMatrixTest extends PHPUnit_Framework_TestCase {
	/**
	 * 
	 * @var Matrix
	 */
	private $_matrix = null;
	
	/**
	 * 
	 * @var integer
	 */
	private $_size = null;

	public function setup() {
		$this->_size = 4;
		$this->_matrix = MatrixFactory::identity($this->_size);
	}

	/**
	 * @test
	 */
	public function matrixIsSquare() {
		$this->assertEquals($this->_size, $this->_matrix->getSize(1));
		$this->assertEquals($this->_size, $this->_matrix->getSize(2));
	}
	
	/**
	 * @test
	 */
	public function matrixHasOnesInDiagonal() {
		$ones = true;
		for($i = 0; $i < $this->_size; $i++) {
			if($this->_matrix->get($i, $i) != 1) {
				$ones = false;
				break;
			}
		}
		
		$this->assertTrue($ones);
	}
	
	/**
	 * @test
	 */
	public function matrixHasZerosOutOfDiagonal() {
		$zeros = true;
		for($i = 0; $i < $this->_size; $i++) {
			for($j = 0; $j < $this->_size; $j++) {
				if($i != $j && $this->_matrix->get($i, $j) != 0) {
					$zeros = false;
					break;
				}
			}
		}
		
		$this->assertTrue($zeros);
	}
}