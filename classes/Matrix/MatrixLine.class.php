<?php
abstract class MatrixLine extends ArrayIterator {

	public function size() {
		return $this->count();
	}
	
	public function isEqual(MatrixLine $line) {
		if($line->size() != $this->size()) {
			return false;
		}
		
		foreach($this AS $current) {
			if($current != $line->current()) {
				return false;
			}
			
			$line->next();
		}
		
		return true;
	}
}