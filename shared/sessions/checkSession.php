<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['sessionKey']) === false){
	$validateFlag = 400;
}
else{
	$sessionKey = $_POST['sessionKey'];
}

if($validateFlag == 200){
	echo md5($sessionKey);
}
else if($validateFlag == 401){
	header($_SERVER['SERVER_PROTOCOL'] . ' 401 Unauthorized', true, 401);
}
else{
	header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request', true, 400);
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>