<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

function setTableVersion($tableName){
	$validateFlag = 200;
	
	if(isset($tableName) === false){
		$validateFlag = 400;
	}
	
	$lastModified = microtime();
	
	if($validateFlag == 200){
		if(isset($con) === false){$con = dbConnection();}
		$stmt = $con->stmt_init();
		$stmt->prepare("
			DELETE FROM
				`s0`.`tableVersions`
			WHERE
				`s0`.`tableVersions`.`tableName` = ?
			LIMIT 1
		");
		$stmt->bind_param('s', $tableName);
		$stmt->execute();
		
		if(isset($con) === false){$con = dbConnection();}
		$stmt = $con->stmt_init();
		$stmt->prepare("
			INSERT INTO
				`s0`.`tableVersions`
			(
				`s0`.`tableVersions`.`tableName`,
				`s0`.`tableVersions`.`lastModified`
			)
			VALUES
			(
				?,
				?
			)
		");
		$stmt->bind_param('ss', $tableName, $lastModified);
		$stmt->execute();
	}
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>