<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

$systemUsers_id = $_SESSION['systemUsers_id'];

if($validateFlag == 200){
			if(isset($con) === false){$con = dbConnection();}
		$stmt = $con->stmt_init();
	$stmt->prepare("
		SELECT
			`c0`.`exports`.`id` AS `exports_id`,
			`c0`.`exports`.`status` AS `exports_status`
		FROM
			`c0`.`exports`
		WHERE
			`c0`.`exports`.`modalId` = ?
			AND
			`c0`.`exports`.`users_id` = ?
		ORDER BY
			`c0`.`exports`.`id` DESC
		LIMIT 1
	");
	$stmt->bind_param('si', $modalId, $users_id);
	$stmt->execute();
	$result = $stmt->get_result();
	
	if(mysqli_num_rows($result) == 0){
	}
	else{
		while($row = mysqli_fetch_assoc($result)){
			$id = $row['exports_id'];
			$status = $row['exports_status'];
		}
	}
	$result->close();
	
			if(isset($con) === false){$con = dbConnection();}
		$stmt = $con->stmt_init();
	$stmt->prepare("
		DELETE FROM
			`c0`.`exports`
		WHERE
			`c0`.`exports`.`modalId` = ?
			AND
			`c0`.`exports`.`users_id` = ?
		ORDER BY
			`c0`.`exports`.`id` DESC
	");
	$stmt->bind_param('si', $modalId, $users_id);
	$stmt->execute();
	
	if($status == 200){
		echo '200';
	}
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>