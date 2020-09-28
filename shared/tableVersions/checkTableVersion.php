<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['tableName']) === false){
	$validateFlag = 400;
}
else{
	$tableName = $_POST['tableName'];
	$tableName_array = explode(',', $tableName);
}

if(isset($_POST['checksum']) === false){
	$validateFlag = 400;
}
else{
	$checksum = $_POST['checksum'];
}

if($validateFlag == 200){
	$tableVersions_lastModified = '';
	foreach($tableName_array as $tableName){
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
			$tableVersions_lastModified = $tableVersions_lastModified . 0;
		}
		else{
			while($row = mysqli_fetch_assoc($result)){
				$tableVersions_lastModified = $tableVersions_lastModified . $row['tableVersions_lastModified'];
			}
		}
		$result->close();
	}
	
	if($tableVersions_lastModified == $checksum){
		echo $tableVersions_lastModified;
	}
	else{
		echo $tableVersions_lastModified;
	}
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>