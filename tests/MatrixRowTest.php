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
class MatrixRowTest extends PHPUnit_Framework_TestCase {
	private $_matrix = null;

	public function setUp() {
		$data = array(
			array(1, 3, 5),
			array(2, 4, 6)
		);
		$this->_matrix = MatrixFactory::createFromArray(2, 3, $data);
	}

	/**
	 * @test
	 */
	public function returnsMatrixRowCorrectly() {
		$row = $this->_matrix->getRow(1);
		$this->assertEquals(3, $row->current());
		$row->next();
		$this->assertEquals(4, $row->current());
	}

	/**
	 * @test
	 */
	public function returnsSizeCorrectly() {
		$row = $this->_matrix->getRow(1);
		$this->assertEquals(2, $row->size());
	}
}