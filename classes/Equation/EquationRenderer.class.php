<?php
class EquationRenderer {
	public function html(Equation $eq, INumberFormatter $formatter, IUnknownRenderer $unknownRenderer) {
		$result = null;
		for($i = $eq->getDegree(); $i >= 0; $i--) {
			$coeff = $eq->coeff($i);
			if(is_null($coeff) || $coeff == 0) {
				continue;
			}

			
			$value = $formatter->format($coeff);
			if($coeff > 0 && $i != $eq->getDegree()) {
				$value = ' + ' . $value;
			}
			else {
				$value = preg_replace('/^-/', ' - ', $value);
			}

			$unknown = $unknownRenderer->render($i);

			$result .= preg_replace('/ +/', ' ', $value . ' ' . $unknown);
		}

		if(!is_null($result)) {
			$result = 'y = '. $result;
		}

		return $result;
	}
}
