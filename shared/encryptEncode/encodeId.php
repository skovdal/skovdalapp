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
	
	if($validateFlag == 200){
		return $id . '-' . $check;
	}
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>