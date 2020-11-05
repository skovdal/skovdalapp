<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_GET['id']) === false){
	$validateFlag = 400;
}
else{
	$id = $_GET['id'];
}

// if(isset($_GET['accessToken']) === false){
// 	$validateFlag = 400;
// }
// else{
// 	$accessToken = $_GET['accessToken'];
// }

if($validateFlag == 200){
			if(isset($con) === false){$con = dbConnection();}
		$stmt = $con->stmt_init();
	$stmt->prepare("
		SELECT
			`c0`.`filesMetaData`.`id` AS `filesMetaData_id`,
			`c0`.`filesMetaData`.`name` AS `filesMetaData_name`,
			`c0`.`filesMetaData`.`type` AS `filesMetaData_type`,
			`c0`.`filesContent`.`content` AS `filesContent_content`
		FROM
			`c0`.`filesMetaData`
		INNER JOIN
			`c0`.`filesContent`
		ON
			`c0`.`filesContent`.`filesMetaData_id` = `c0`.`filesMetaData`.`id`
		WHERE
			`c0`.`filesMetaData`.`id` = ?
			AND
			`c0`.`filesMetaData`.`deleteFlag` IS NULL
			AND
			`c0`.`filesMetaData`.`tempFlag` IS NULL
			AND
			`c0`.`filesMetaData`.`legacyFlag` IS NULL
		LIMIT 1
	");
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$result = $stmt->get_result();
	
	if(mysqli_num_rows($result) == 0){
		header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);
	}
	else{
		while($row = mysqli_fetch_assoc($result)){
			if(strpos($row['filesMetaData_name'], '.png') > -1){
				header ('Content-Type: ' . $row['filesMetaData_type']);
				echo base64_decode($row['filesContent_content']);
			}
			else if(strpos($row['filesMetaData_name'], '.jpg') > -1){
				header ('Content-Type: ' . $row['filesMetaData_type']);
				echo base64_decode($row['filesContent_content']);
			}
			else if(strpos($row['filesMetaData_name'], '.jpeg') > -1){
				header ('Content-Type: ' . $row['filesMetaData_type']);
				echo base64_decode($row['filesContent_content']);
			}
		}
	}
	$result->close();
	
	if(getSystemConfigurations('logFiles') == 1 || getSystemConfigurations('logFiles') == -1){
		$type = 'view';
		$trigger_systemUsers_id = $_SESSION['systemUsers_id'];
		$ipAddress = $_SERVER['REMOTE_ADDR'];
		$startTime = $systemEvents_addEvent_startTime;
		$endTime = microtime(true);
		$latency = ($endTime - $startTime);
		$finished = 0;
		$host = $_SERVER['SERVER_NAME'];
		$httpVersion = $_SERVER['SERVER_PROTOCOL'];
		$instanceId = session_id();
		$method = $_SERVER['REQUEST_METHOD'];
		$status = $validateFlag;
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		$version = date('YmdHisu', filemtime(__FILE__));
		$postData = json_encode($_POST);
		$getData = json_encode($_GET);
		$httpsEnabled = $_SERVER['HTTPS'];
		$fileName = $_SERVER['SCRIPT_FILENAME'];
		$devices_id = null;
		$exports_id = null;
		$filesContent_id = null;
		$filesMetaData_id = null;
		$identities_id = null;
		$meetings_id = null;
		$policies_id = null;
		$processingActivities_id = null;
		$processingActivitiesLegalBasises_id = null;
		$progressTime_id = null;
		$pseudoNames_id = null;
		$sessions_id = null;
		$systemConfigurations_id = null;
		$systemEvents_id = null;
		$systemNotifications_id = null;
		$systemStorages_id = null;
		$systemUsers_id = null;
		$systemUsersSystemPreferences_id = null;
		$tableVersions_id = null;
		$tags_id = null;
		$tagsReferences_id = null;
		
		addSystemEvent(
			$trigger_systemUsers_id,
			$type,
			$ipAddress,
			$startTime,
			$endTime,
			$finished,
			$host,
			$httpVersion,
			$instanceId,
			$method,
			$status,
			$userAgent,
			$version,
			$postData,
			$getData,
			$httpsEnabled,
			$fileName,
			$devices_id,
			$exports_id,
			$filesContent_id,
			$filesMetaData_id,
			$identities_id,
			$meetings_id,
			$policies_id,
			$processingActivities_id,
			$processingActivitiesLegalBasises_id,
			$progressTime_id,
			$pseudoNames_id,
			$sessions_id,
			$systemConfigurations_id,
			$systemEvents_id,
			$systemNotifications_id,
			$systemStorages_id,
			$systemUsers_id,
			$systemUsersSystemPreferences_id,
			$tableVersions_id,
			$tags_id,
			$tagsReferences_id
		);
	}
}
else{
	if(getSystemConfigurations('logFiles') == 1 || getSystemConfigurations('logFiles') == -1){
		$type = 'view';
		$trigger_systemUsers_id = $_SESSION['systemUsers_id'];
		$ipAddress = $_SERVER['REMOTE_ADDR'];
		$startTime = $systemEvents_addEvent_startTime;
		$endTime = microtime(true);
		$latency = ($endTime - $startTime);
		$finished = 0;
		$host = $_SERVER['SERVER_NAME'];
		$httpVersion = $_SERVER['SERVER_PROTOCOL'];
		$instanceId = session_id();
		$method = $_SERVER['REQUEST_METHOD'];
		$status = $validateFlag;
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		$version = date('YmdHisu', filemtime(__FILE__));
		$postData = json_encode($_POST);
		$getData = json_encode($_GET);
		$httpsEnabled = $_SERVER['HTTPS'];
		$fileName = $_SERVER['SCRIPT_FILENAME'];
		$devices_id = null;
		$exports_id = null;
		$filesContent_id = null;
		$filesMetaData_id = null;
		$identities_id = null;
		$meetings_id = null;
		$policies_id = null;
		$processingActivities_id = null;
		$processingActivitiesLegalBasises_id = null;
		$progressTime_id = null;
		$pseudoNames_id = null;
		$sessions_id = null;
		$systemConfigurations_id = null;
		$systemEvents_id = null;
		$systemNotifications_id = null;
		$systemStorages_id = null;
		$systemUsers_id = null;
		$systemUsersSystemPreferences_id = null;
		$tableVersions_id = null;
		$tags_id = null;
		$tagsReferences_id = null;
		
		addSystemEvent(
			$trigger_systemUsers_id,
			$type,
			$ipAddress,
			$startTime,
			$endTime,
			$finished,
			$host,
			$httpVersion,
			$instanceId,
			$method,
			$status,
			$userAgent,
			$version,
			$postData,
			$getData,
			$httpsEnabled,
			$fileName,
			$devices_id,
			$exports_id,
			$filesContent_id,
			$filesMetaData_id,
			$identities_id,
			$meetings_id,
			$policies_id,
			$processingActivities_id,
			$processingActivitiesLegalBasises_id,
			$progressTime_id,
			$pseudoNames_id,
			$sessions_id,
			$systemConfigurations_id,
			$systemEvents_id,
			$systemNotifications_id,
			$systemStorages_id,
			$systemUsers_id,
			$systemUsersSystemPreferences_id,
			$tableVersions_id,
			$tags_id,
			$tagsReferences_id
		);
	}
	
	httpStatusCodes($validateFlag);
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>