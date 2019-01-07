<?php
	function sum($a, $b) {
		return $a + $b;
	}

	function dif($a, $b) {
		return $a - $b;
	}

	function mult($a, $b) {
		return $a * $b;
	}

	function div($a, $b) {
		return $b!=0?$a/$b:"На ноль делить нельзя";
	}

	function mathOperation($arg1, $arg2, $operation) {
		switch($operation) {
			case "+":
				$answer = sum($arg1, $arg2);
				break;
			case "-":
				$answer = dif($arg1, $arg2);
				break;
			case "*":
				$answer = mult($arg1, $arg2);
				break;
			case "/":
				$answer = div($arg1, $arg2);
				break;
		}

		return $answer;
	}

	$val1 = $_GET['val1'];
	$val2 = $_GET['val2'];
	$operation = $_GET['operation'];
	$str = '';
	$style = "style='margin-left: 5px;'";
	
	if (isset($_GET['operation'])) {
		$answer = mathOperation($val1, $val2, $operation[0]);
		$str .= "<input type='text' value='$val1'><input type='button' value='$operation[0]' {$style}><input type='text' value='$val2' {$style}><input type='button' value='=' {$style}><input type='text' {$style} value='$answer'><br><br><a href='/'>Назад</a>";

		echo $str;
	}
?>