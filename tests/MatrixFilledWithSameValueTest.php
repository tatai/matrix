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
class MatrixFilledWithSameValueTest extends PHPUnit_Framework_TestCase {
	private $_matrix = null;
	private $_x = null;
	private $_y = null;
	private $_filled_with = null;

	public function setUp() {
		$this->_x = 1;
		$this->_y = 3;
		$this->_filled_with = 3;
		
		$this->_matrix = MatrixFactory::createWithInitialValue($this->_x, $this->_y, $this->_filled_with);
	}
	
	/**
	 * @test
	 */
	public function givenValueMustBeNumeric() {
		$this->assertNull(MatrixFactory::createWithInitialValue(1, 2, array()));
	}

	/**
	 * @test
	 */
	public function canGetValuesFromAnyPosition() {
		$value = 3;
		for($i = 0; $i < $this->_x; $i++) {
			for($j = 0; $j < $this->_y; $j++) {
				$value |= $this->_matrix->get($i, $j);
			}
		}
		
		$this->assertEquals($this->_filled_with, $value);
	}

	/**
	 * @test
	 */
	public function getValueFromOutsidePositionReturnsFalse() {
		$this->assertFalse($this->_matrix->get(1, 3));
	}

	/**
	 * @test
	 */
	public function canSetValueInAnyCell() {
		$x = 0;
		$y = 2;
		$set = 10;
		$this->_matrix->set($x, $y, $set);
		
		$value = 3;
		$valueSum = 0;
		for($i = 0; $i < $this->_x; $i++) {
			for($j = 0; $j < $this->_y; $j++) {
				$get = $this->_matrix->get($i, $j);
				if($i != $x && $j != $y) {
					$value |= $get;
				}
				$valueSum += $get;
			}
		}

		$this->assertEquals($this->_filled_with, $value);
		$this->assertEquals($this->_filled_with * ($this->_x * $this->_y - 1) + $set, $valueSum);
	}
	
	/**
	 * @test
	 */
	public function settingValueInOutsidePositionReturnsFalse() {
		$this->assertFalse($this->_matrix->set(2, 3, 0));
	}
}