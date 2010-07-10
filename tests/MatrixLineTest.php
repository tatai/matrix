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
class MatrixLineTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var MatrixRow
	 */
	private $_row = null;
	
	private $_data = null;

	public function setUp() {
		$this->_data = array(1, 2, 3, 4, 5);
		$this->_row = new MatrixRow($this->_data);
	}

	/**
	 * @test
	 */
	public function comparingSameRowsGivesSameValueReturnsTrue() {
		$check = new MatrixRow($this->_data);
		$this->assertTrue($this->_row->isEqual($check));
	}

	/**
	 * @test
	 */
	public function comparingRowsOfDifferentSizeReturnsFalse() {
		$data = array(1, 2, 3);
		$check = new MatrixRow($data);
		$this->assertFalse($this->_row->isEqual($check));
	}

	/**
	 * @test
	 */
	public function comparingRowsOfSameSizeButDifferentValuesReturnsFalse() {
		$data = array(2, 3, 4, 5, 6);
		$check = new MatrixRow($data);
		$this->assertFalse($this->_row->isEqual($check));
	}
}