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
class ComparingMatrixTest extends PHPUnit_Framework_TestCase {
	private $_matrix = null;

	public function setUp() {
		$data = array(
			array(1, 3, 3),
			array(1, 4, 3),
			array(1, 3, 4)
		);
		$this->_matrix = MatrixFactory::createFromArray(3, 3, $data);
	}

	/**
	 * @test
	 */
	public function oneMatrixCompareWithItselfIsEqual() {
		$this->assertTrue($this->_matrix->isEqual($this->_matrix));
	}

	/**
	 * @test
	 */
	public function oneMatrixCompareWithAnotherWithSameDataIsEqual() {
		$data = array(
			array(1, 3, 3),
			array(1, 4, 3),
			array(1, 3, 4)
		);
		$matrix = MatrixFactory::createFromArray(3, 3, $data);
		
		$this->assertTrue($this->_matrix->isEqual($matrix));
	}
	
	/**
	 * @test
	 */
	public function oneSingleValueMakeMatrixDifferent() {
		$data = array(
			array(1, 3, 3),
			array(1, 1, 3),
			array(1, 3, 4)
		);
		$matrix = MatrixFactory::createFromArray(3, 3, $data);
		
		$this->assertFalse($this->_matrix->isEqual($matrix));
	}

	/**
	 * @test
	 */
	public function havingDifferentNumberOfRowsReturnsFalse() {
		$matrix = MatrixFactory::createWithInitialValue($this->_matrix->getSize(1) + 1, $this->_matrix->getSize(2), 2);
		
		$this->assertFalse($this->_matrix->isEqual($matrix));
		
	}
	
	/**
	 * @test
	 */
	public function havingDifferentNumberOfColumnsReturnsFalse() {
		$matrix = MatrixFactory::createWithInitialValue($this->_matrix->getSize(1), $this->_matrix->getSize(2) + 1, 2);
		
		$this->assertFalse($this->_matrix->isEqual($matrix));
		
	}
}