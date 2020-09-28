<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

function addSystemEvent(
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
	){
	$validateFlag = 200;
	
	if($finished == 1){
		$finished = 1;
	}
	else{
		$finished = null;
	}
	
	if($httpsEnabled == 'on'){
		$httpsEnabled = 1;
	}
	else{
		$httpsEnabled = null;
	}
	
	if($validateFlag == 200){
		if(isset($con) === false){$con = dbConnection();}
		$stmt = $con->stmt_init();
		$stmt->prepare("
			INSERT INTO
				`c0`.`systemEvents`
			(
				`c0`.`systemEvents`.`trigger_systemUsers_id`,
				`c0`.`systemEvents`.`type`,
				`c0`.`systemEvents`.`ipAddress`,
				`c0`.`systemEvents`.`startTime`,
				`c0`.`systemEvents`.`endTime`,
				`c0`.`systemEvents`.`finished`,
				`c0`.`systemEvents`.`host`,
				`c0`.`systemEvents`.`httpVersion`,
				`c0`.`systemEvents`.`instanceId`,
				`c0`.`systemEvents`.`method`,
				`c0`.`systemEvents`.`status`,
				`c0`.`systemEvents`.`userAgent`,
				`c0`.`systemEvents`.`version`,
				`c0`.`systemEvents`.`postData`,
				`c0`.`systemEvents`.`getData`,
				`c0`.`systemEvents`.`httpsEnabled`,
				`c0`.`systemEvents`.`fileName`,
				`c0`.`systemEvents`.`devices_id`,
				`c0`.`systemEvents`.`exports_id`,
				`c0`.`systemEvents`.`filesContent_id`,
				`c0`.`systemEvents`.`filesMetaData_id`,
				`c0`.`systemEvents`.`identities_id`,
				`c0`.`systemEvents`.`meetings_id`,
				`c0`.`systemEvents`.`policies_id`,
				`c0`.`systemEvents`.`processingActivities_id`,
				`c0`.`systemEvents`.`processingActivitiesLegalBasises_id`,
				`c0`.`systemEvents`.`progressTime_id`,
				`c0`.`systemEvents`.`pseudoNames_id`,
				`c0`.`systemEvents`.`sessions_id`,
				`c0`.`systemEvents`.`systemConfigurations_id`,
				`c0`.`systemEvents`.`systemEvents_id`,
				`c0`.`systemEvents`.`systemNotifications_id`,
				`c0`.`systemEvents`.`systemStorages_id`,
				`c0`.`systemEvents`.`systemUsers_id`,
				`c0`.`systemEvents`.`systemUsersSystemPreferences_id`,
				`c0`.`systemEvents`.`tableVersions_id`,
				`c0`.`systemEvents`.`tags_id`,
				`c0`.`systemEvents`.`tagsReferences_id`
			)
			VALUES
			(
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?
			)
		");
		$stmt->bind_param('issssisssssssssisiiiiiiiiiiiiiiiiiiiii', $trigger_systemUsers_id, $type, $ipAddress, $startTime, $endTime, $finished, $host, $httpVersion, $instanceId, $method, $status, $userAgent, $version, $postData, $getData, $httpsEnabled, $fileName, $devices_id, $exports_id, $filesContent_id, $filesMetaData_id, $identities_id, $meetings_id, $policies_id, $processingActivities_id, $processingActivitiesLegalBasises_id, $progressTime_id, $pseudoNames_id, $sessions_id, $systemConfigurations_id, $systemEvents_id, $systemNotifications_id, $systemStorages_id, $systemUsers_id, $systemUsersSystemPreferences_id, $tableVersions_id, $tags_id, $tagsReferences_id);
		$stmt->execute();
		setTableVersion('systemEvents');
	}
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>