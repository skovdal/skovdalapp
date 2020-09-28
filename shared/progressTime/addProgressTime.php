<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['url']) === false){
	$validateFlag = 400;
}
else{
	$url = $_POST['url'];
}

if(isset($_POST['time']) === false){
	$validateFlag = 400;
}
else{
	$time = $_POST['time'];
}

if($validateFlag == 200){
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
		INSERT INTO
			`s0`.`progressTime`
		(
			`s0`.`url`,
			`s0`.`time`
		)
		VALUES
		(
			?,
			?
		)
	");
	$stmt->bind_param('ss', $url, $time);
	$stmt->execute();
	setTableVersion('progressTime');
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>