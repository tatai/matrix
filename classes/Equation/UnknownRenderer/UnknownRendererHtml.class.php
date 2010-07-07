<?php
class UnknownRendererHtml implements IUnknownRenderer {
	public function render($degree) {
		if($degree == 0) {
			return '';
		}
		else if($degree == 1) {
			return 'x';
		}
		else {
			return 'x<sup>' . $degree . '</sup>';
		}
	}
}