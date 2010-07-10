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
class MatrixRowColumnOperations {
	private function __construct() {
	}

	static public function multiplyRowBy(Matrix $matrix, $row, $value) {
		if($row + 1 > $matrix->getSize(2)) {
			return false;
		}

		$size = $matrix->getSize(1);
		for($i = 0; $i < $size; $i++) {
			$matrix->set($i, $row, $matrix->get($i, $row) * $value);
		}
		
		return true;
	}

	static public function multiplyColumnBy(Matrix $matrix, $column, $value) {
		if($column + 1 > $matrix->getSize(1)) {
			return false;
		}

		$size = $matrix->getSize(2);
		for($i = 0; $i < $size; $i++) {
			$matrix->set($column, $i, $matrix->get($column, $i) * $value);
		}
		
		return true;
	}

	static public function swapRows(Matrix $matrix, $firstRow, $secondRow) {
		if($firstRow > $matrix->getSize(2) - 1 || $secondRow > $matrix->getSize(2) - 1) {
			return false;
		}

		$interchange = $matrix->getRow($firstRow);
		
		while($interchange->current()) {
			$matrix->set($interchange->key(), $firstRow, $matrix->get($interchange->key(), $secondRow));
			$matrix->set($interchange->key(), $secondRow, $interchange->current());
			$interchange->next();
		}
	}

	static public function swapColumns(Matrix $matrix, $firstColumn, $secondColumn) {
		if($firstColumn > $matrix->getSize(1) - 1 || $secondColumn > $matrix->getSize(1) - 1) {
			return false;
		}

		$interchange = $matrix->getColumn($firstColumn);
		
		while($interchange->current()) {
			$matrix->set($firstColumn, $interchange->key(), $matrix->get($secondColumn, $interchange->key()));
			$matrix->set($secondColumn, $interchange->key(), $interchange->current());
			$interchange->next();
		}
	}
}