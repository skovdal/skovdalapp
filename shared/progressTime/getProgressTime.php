<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

function getProgressTime($url){
	$validateFlag = 200;
	
	if(isset($url) === false){
		$validateFlag = 400;
	}
	
	if($validateFlag == 200){
		if(isset($con) === false){$con = dbConnection();}
		$stmt = $con->stmt_init();
		$stmt->prepare("
			SELECT
				`s0`.`progressTime`.`time` AS `progressTime_time`
			FROM
				`s0`.`progressTime`
			WHERE
				`s0`.`progressTime`.`url` = ?
			ORDER BY
				`s0`.`progressTime`.`id` DESC
			LIMIT 10
		");
		$stmt->bind_param('s', $url);
		$stmt->execute();
		$result = $stmt->get_result();
		
		if(mysqli_num_rows($result) == 0){
			return 10000;
		}
		else{
			$row = mysqli_fetch_assoc($result);
			return $row['progressTime_time'];
		}
		$result->close();
	}
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>