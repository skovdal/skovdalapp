<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

function decodeId($id){
	$validateFlag = 200;
	
	if(isset($id) === false){
		$validateFlag = 400;
	}
	
	$id_array = explode('-', $id);
	if(count($id_array) == 2){
		$systemUsers_id = $_SESSION['systemUsers_id'];
		$sessionId = session_id();
		
		$id = $id_array[0];
		$id = strval($id);
		$id = str_ireplace('A', '1', $id);
		$id = str_ireplace('W', '2', $id);
		$id = str_ireplace('B', '3', $id);
		$id = str_ireplace('V', '4', $id);
		$id = str_ireplace('T', '5', $id);
		$id = str_ireplace('K', '6', $id);
		$id = str_ireplace('L', '7', $id);
		$id = str_ireplace('O', '8', $id);
		$id = str_ireplace('P', '9', $id);
		$id = str_ireplace('F', '0', $id);
		$id = intval($id);
		$id = $id / $systemUsers_id;
		
		$check = $id * $systemUsers_id;
		$check = (0 - $check) * -1;
		$check = strval($check);
		$check = str_ireplace('1', 'K', $check);
		$check = str_ireplace('2', 'F', $check);
		$check = str_ireplace('3', 'V', $check);
		$check = str_ireplace('4', 'E', $check);
		$check = str_ireplace('5', 'B', $check);
		$check = str_ireplace('6', 'W', $check);
		$check = str_ireplace('7', 'N', $check);
		$check = str_ireplace('8', 'I', $check);
		$check = str_ireplace('9', 'R', $check);
		$check = str_ireplace('0', 'X', $check);
		
		if(is_int($id) === false){
			$validateFlag = 400;
		}
		
		if($check != $id_array[1]){
			$validateFlag = 400;
		}
	}
	else{
		$validateFlag = 400;
	}
	
	if($validateFlag == 200){
		return $id;
	}
	else{
		return -1;
	}
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>