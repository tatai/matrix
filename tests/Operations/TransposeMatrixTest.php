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
class TransposeMatrixTest extends PHPUnit_Framework_TestCase {
	/**
	 * Matriz a usar
	 * 
	 * @var Matrix
	 * @private
	 */
	private $_matrix = null;

	public function setUp() {
		$this->_xSize = 4;
		$this->_ySize = 3;
		
		$this->_data = $this->_generateData($this->_xSize, $this->_ySize);
		$this->_matrix = MatrixFactory::createFromArray($this->_xSize, $this->_ySize, $this->_data);
	}

	private function _generateData($x, $y) {
		$data = array();
		for($i = 0; $i < $x; $i++) {
			for($j = 0; $j < $y; $j++) {
				$data[$i][$j] = rand(0, 50);
			}
		}
		
		return $data;
	}

	/**
	 * @test
	 */
	public function transposeReturnsMatrixObject() {
		$this->assertTrue(MatrixOperations::transpose($this->_matrix) instanceof Matrix);
	}
	
	/**
	 * @test
	 */
	public function returnsSwappedSizes() {
		$transpose = MatrixOperations::transpose($this->_matrix);
		$this->assertEquals($this->_ySize, $transpose->getSize(1));
		$this->assertEquals($this->_xSize, $transpose->getSize(2));
	}
	
	/**
	 * @test
	 */
	public function transposingTwiceGetSameOriginalMatrix() {
		$this->assertTrue($this->_matrix->isEqual(MatrixOperations::transpose(MatrixOperations::transpose($this->_matrix))));
	}
	
	/**
	 * @test
	 */
	public function returnsCorrectValues() {
		$transpose = MatrixOperations::transpose($this->_matrix);
		
		$values = array();
		for($i = 0; $i < $this->_xSize; $i++) {
			for($j = 0; $j < $this->_ySize; $j++) {
				$values[$j][$i] = $this->_matrix->get($i, $j);
			}
		}
		
		$check = MatrixFactory::createFromArray($this->_ySize, $this->_xSize, $values);
		
		$this->assertTrue($transpose->isEqual($check));
	}
}