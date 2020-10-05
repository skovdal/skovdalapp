<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

function encodeId($id){
	$validateFlag = 200;
	
	if(isset($id) === false){
		$validateFlag = 400;
		$id = 0;
	}
	
	$systemUsers_id = $_SESSION['systemUsers_id'];
	$sessionId = session_id();
	
	$check3 = $id * $systemUsers_id;
	$check3 = (0 - $check3) * -1;
	$check3 = strval($check3);
	$check3 = str_ireplace('1', 'K', $check3);
	$check3 = str_ireplace('2', 'F', $check3);
	$check3 = str_ireplace('3', 'V', $check3);
	$check3 = str_ireplace('4', 'E', $check3);
	$check3 = str_ireplace('5', 'B', $check3);
	$check3 = str_ireplace('6', 'W', $check3);
	$check3 = str_ireplace('7', 'N', $check3);
	$check3 = str_ireplace('8', 'I', $check3);
	$check3 = str_ireplace('9', 'R', $check3);
	$check3 = str_ireplace('0', 'X', $check3);
	
	$id = intval($id);
	$id = $id * $systemUsers_id;
	$id = strval($id);
	$id = str_ireplace('1', 'A', $id);
	$id = str_ireplace('2', 'W', $id);
	$id = str_ireplace('3', 'B', $id);
	$id = str_ireplace('4', 'V', $id);
	$id = str_ireplace('5', 'T', $id);
	$id = str_ireplace('6', 'K', $id);
	$id = str_ireplace('7', 'L', $id);
	$id = str_ireplace('8', 'O', $id);
	$id = str_ireplace('9', 'P', $id);
	$id = str_ireplace('0', 'F', $id);
	
	if(strlen(preg_replace('/\D/', '', $sessionId)) > 0){
		$check = preg_replace('/\D/', '', $sessionId);
		$check = strval($check);
		$check = str_ireplace('1', 'B', $check);
		$check = str_ireplace('2', 'H', $check);
		$check = str_ireplace('3', 'Y', $check);
		$check = str_ireplace('4', 'V', $check);
		$check = str_ireplace('5', 'T', $check);
		$check = str_ireplace('6', 'F', $check);
		$check = str_ireplace('7', 'S', $check);
		$check = str_ireplace('8', 'G', $check);
		$check = str_ireplace('9', 'J', $check);
		$check = str_ireplace('0', 'E', $check);
	}
	else{
		$check = preg_replace('/[^a-zA-Z]/', '', $sessionId);
		$check = str_ireplace('A', 'R', $check);
		$check = str_ireplace('B', 'V', $check);
		$check = str_ireplace('C', 'H', $check);
		$check = str_ireplace('D', 'M', $check);
		$check = str_ireplace('E', 'T', $check);
		$check = str_ireplace('F', 'A', $check);
		$check = str_ireplace('G', 'N', $check);
		$check = str_ireplace('H', 'B', $check);
		$check = str_ireplace('I', 'E', $check);
		$check = str_ireplace('J', 'P', $check);
		$check = str_ireplace('K', 'Z', $check);
		$check = str_ireplace('L', 'Y', $check);
		$check = str_ireplace('M', 'O', $check);
		$check = str_ireplace('N', 'C', $check);
		$check = str_ireplace('O', 'Q', $check);
		$check = str_ireplace('P', 'U', $check);
		$check = str_ireplace('Q', 'S', $check);
		$check = str_ireplace('R', 'W', $check);
		$check = str_ireplace('S', 'J', $check);
		$check = str_ireplace('T', 'G', $check);
		$check = str_ireplace('U', 'K', $check);
		$check = str_ireplace('V', 'L', $check);
		$check = str_ireplace('W', 'I', $check);
		$check = str_ireplace('X', 'X', $check);
		$check = str_ireplace('Y', 'D', $check);
		$check = str_ireplace('Z', 'F', $check);
	}
	
	if(strlen(preg_replace('/\D/', '', $sessionId)) > 0){
		$check2 = preg_replace('/\D/', '', $sessionId);
		$check2 = intval($check2);
		$check2 = $check2 * $systemUsers_id;
		$check2 = strval($check2);
		$check2 = str_ireplace('1', 'M', $check2);
		$check2 = str_ireplace('2', 'J', $check2);
		$check2 = str_ireplace('3', 'F', $check2);
		$check2 = str_ireplace('4', 'U', $check2);
		$check2 = str_ireplace('5', 'C', $check2);
		$check2 = str_ireplace('6', 'S', $check2);
		$check2 = str_ireplace('7', 'B', $check2);
		$check2 = str_ireplace('8', 'Q', $check2);
		$check2 = str_ireplace('9', 'Z', $check2);
		$check2 = str_ireplace('0', 'X', $check2);
	}
	else{
		$check2 = preg_replace('/[^a-z]/i', '', $sessionId);
		$check2 = str_ireplace('A', '3', $check2);
		$check2 = str_ireplace('B', '3', $check2);
		$check2 = str_ireplace('C', '3', $check2);
		$check2 = str_ireplace('D', '6', $check2);
		$check2 = str_ireplace('E', '3', $check2);
		$check2 = str_ireplace('F', '6', $check2);
		$check2 = str_ireplace('G', '8', $check2);
		$check2 = str_ireplace('H', '3', $check2);
		$check2 = str_ireplace('I', '2', $check2);
		$check2 = str_ireplace('J', '6', $check2);
		$check2 = str_ireplace('K', '9', $check2);
		$check2 = str_ireplace('L', '1', $check2);
		$check2 = str_ireplace('M', '2', $check2);
		$check2 = str_ireplace('N', '5', $check2);
		$check2 = str_ireplace('O', '5', $check2);
		$check2 = str_ireplace('P', '6', $check2);
		$check2 = str_ireplace('Q', '2', $check2);
		$check2 = str_ireplace('R', '1', $check2);
		$check2 = str_ireplace('S', '9', $check2);
		$check2 = str_ireplace('T', '8', $check2);
		$check2 = str_ireplace('U', '4', $check2);
		$check2 = str_ireplace('V', '2', $check2);
		$check2 = str_ireplace('W', '6', $check2);
		$check2 = str_ireplace('X', '7', $check2);
		$check2 = str_ireplace('Y', '8', $check2);
		$check2 = str_ireplace('Z', '4', $check2);
		$check2 = intval($check2);
		$check2 = $check2 * $systemUsers_id;
		$check2 = strval($check2);
		$check2 = str_ireplace('1', 'M', $check2);
		$check2 = str_ireplace('2', 'J', $check2);
		$check2 = str_ireplace('3', 'F', $check2);
		$check2 = str_ireplace('4', 'U', $check2);
		$check2 = str_ireplace('5', 'C', $check2);
		$check2 = str_ireplace('6', 'S', $check2);
		$check2 = str_ireplace('7', 'B', $check2);
		$check2 = str_ireplace('8', 'Q', $check2);
		$check2 = str_ireplace('9', 'Z', $check2);
		$check2 = str_ireplace('0', 'X', $check2);
	}
	
	if($validateFlag == 200){
		return $id . '-' . $check . '-' . $check2 . '-' . $check3;
	}
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>