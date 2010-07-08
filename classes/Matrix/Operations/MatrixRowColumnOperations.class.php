<?php
class MatrixRowColumnOperations {

	public function multiplyRowBy(Matrix $matrix, $row, $value) {
		$size = $matrix->getSize(1);
		for($i = 0; $i < $size; $i++) {
			$matrix->set($i, $row, $matrix->get($i, $row) * $value);
		}
	}

	public function multiplyColumnBy(Matrix $matrix, $column, $value) {
		$size = $matrix->getSize(2);
		for($i = 0; $i < $size; $i++) {
			$matrix->set($column, $i, $matrix->get($column, $i) * $value);
		}
	}

	public function substractRow(Matrix $matrix, $targetRow, $fromRow) {
		$size = $matrix->getSize(1);
		for($i = 0; $i < $size; $i++) {
			$matrix->set($i, $targetRow, $matrix->get($fromRow, $i));
		}
	}

	public function swapRows(Matrix $matrix, $firstRow, $secondRow) {
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

	public function swapColumns(Matrix $matrix, $firstColumn, $secondColumn) {
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