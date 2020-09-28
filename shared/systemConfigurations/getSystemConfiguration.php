<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

function getSystemConfigurations($systemConfiguration){
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
		SELECT
			`s0`.`systemConfigurations`.`value` AS `systemConfigurations_value`
		FROM
			`s0`.`systemConfigurations`
		WHERE
			`s0`.`systemConfigurations`.`systemConfiguration` = ?
		LIMIT 1
	");
	$stmt->bind_param('s', $systemConfiguration);
	$stmt->execute();
	$result = $stmt->get_result();
	
	if(mysqli_num_rows($result) == 0){
		return -1;
	}
	else{
		while($row = mysqli_fetch_assoc($result)){
			return $row['systemConfigurations_value'];
		}
	}
	$result->close();
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>