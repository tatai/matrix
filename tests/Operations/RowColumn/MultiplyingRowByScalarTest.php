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
class MultiplyingRowByScalarTest extends PHPUnit_Framework_TestCase {
	/**
	 * 
	 * @var Matrix
	 */
	private $_matrix = null;
	
	/**
	 * 
	 * @var array
	 */
	private $_data = null;

	public function setUp() {
		$this->_data = array(
			array(1, 3, 3),
			array(1, 4, 3),
			array(1, 3, 4)
		);
		$this->_matrix = MatrixFactory::createFromArray(3, 3, $this->_data);
	}
	
	/**
	 * @test
	 */
	public function whenRowDoesNotExistsReturnsFalseAndMatrixIsNotChanged() {
		$original = clone $this->_matrix;
		
		$this->assertFalse(MatrixRowColumnOperations::multiplyRowBy($this->_matrix, count($this->_data), 10));
		$this->assertTrue($original->isEqual($this->_matrix));
	}
	
	/**
	 * @test
	 */
	public function ifEverythingWentFineReturnsTrue() {
		$this->assertTrue(MatrixRowColumnOperations::multiplyRowBy($this->_matrix, 1, 10));
	}

	/**
	 * @test
	 */
	public function multiplyRowByTwo() {
		$multiplyBy = 2;

		$result = $this->_data;
		for($i = 0; $i < count($result); $i++) {
			$result[$i][0] *= $multiplyBy;
		}

		MatrixRowColumnOperations::multiplyRowBy($this->_matrix, 0, $multiplyBy);
		
		$this->assertTrue(MatrixFactory::createFromArray(3, 3, $result)->isEqual($this->_matrix));
	}
}