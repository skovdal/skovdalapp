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

require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>