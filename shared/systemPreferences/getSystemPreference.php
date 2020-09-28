<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

function getSystemPreferences($systemPreference){
	$systemUsers_id = $_SESSION['systemUsers_id'];
	
	if(isset($_SESSION['systemUsersSystemPreferences_' . $systemPreference . '_' . $systemUsers_id]) === false){
					if(isset($con) === false){$con = dbConnection();}
		$stmt = $con->stmt_init();
		$stmt->prepare("
			SELECT
				`s0`.`systemUsersSystemPreferences`.`value` AS `systemUsersSystemPreferences_value`
			FROM
				`s0`.`systemUsersSystemPreferences`
			WHERE
				`s0`.`systemUsersSystemPreferences`.`systemPreference` = ?
				AND
				`s0`.`systemUsersSystemPreferences`.`systemUsers_id` = ?
			LIMIT 1
		");
		$stmt->bind_param('si', $systemPreference, $systemUsers_id);
		$stmt->execute();
		$result = $stmt->get_result();
		
		if(mysqli_num_rows($result) == 0){
			return -1;
		}
		else{
			while($row = mysqli_fetch_assoc($result)){
				$_SESSION['systemUsersSystemPreferences_' . $systemPreference . '_' . $systemUsers_id] = $row['systemUsersSystemPreferences_value'];
				return $row['systemUsersSystemPreferences_value'];
			}
		}
		$result->close();
		}
	else{
		$_SESSION['systemUsersSystemPreferences_' . $systemPreference . '_' . $systemUsers_id] = $_SESSION['systemUsersSystemPreferences_' . $systemPreference . '_' . $systemUsers_id];
		return $_SESSION['systemUsersSystemPreferences_' . $systemPreference . '_' . $systemUsers_id];
	}
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>