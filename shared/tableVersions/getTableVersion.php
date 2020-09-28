<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

function getTableVersion($tableName){
	$validateFlag = 200;
	
	if(isset($tableName) === false){
		$validateFlag = 400;
	}
	
	if($validateFlag == 200){
		if(isset($con) === false){$con = dbConnection();}
		$stmt = $con->stmt_init();
		$stmt->prepare("
			SELECT
				`s0`.`tableVersions`.`lastModified` AS `tableVersions_lastModified`
			FROM
				`s0`.`tableVersions`
			WHERE
				`s0`.`tableVersions`.`tableName` = ?
			LIMIT 1
		");
		$stmt->bind_param('s', $tableName);
		$stmt->execute();
		$result = $stmt->get_result();
		
		if(mysqli_num_rows($result) == 0){
			return 0;
		}
		else{
			while($row = mysqli_fetch_assoc($result)){
				$tableVersions_lastModified = $row['tableVersions_lastModified'];
				return $tableVersions_lastModified;
			}
		}
		$result->close();
	}
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>