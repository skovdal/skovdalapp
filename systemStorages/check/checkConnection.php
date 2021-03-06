<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['systemStorages_id']) === false){
	$validateFlag = 400;
}
else{
	$systemStorages_id = $_POST['systemStorages_id'];
	
	if($systemStorages_id > 0){
		if(decodeId($systemStorages_id) == -1){
			$validateFlag = 400;
		}
		else{
			$systemStorages_id = decodeId($systemStorages_id);
		}
	}
	else{
		$systemStorages_id = 0;
	}
}

if(isset($_POST['name']) === false){
	$validateFlag = 400;
}
else{
	$name = $_POST['name'];
}

if(isset($_POST['type']) === false){
	$validateFlag = 400;
}
else{
	$type = $_POST['type'];
}

if($type == 'FTP'){
	if(isset($_POST['ftp_host']) === false){
		$validateFlag = 400;
	}
	else{
		$ftp_host = $_POST['ftp_host'];
	}
}
else if($type == 'FTPS'){
	if(isset($_POST['ftp_host']) === false){
		$validateFlag = 400;
	}
	else{
		$ftp_host = $_POST['ftp_host'];
	}
}
else if($type == 'MySQL 8.0'){
	if(isset($_POST['mysql_host']) === false){
		$validateFlag = 400;
	}
	else{
		$mysql_host = $_POST['mysql_host'];
	}
	
	if(isset($_POST['mysql_username']) === false){
		$validateFlag = 400;
	}
	else{
		$mysql_username = $_POST['mysql_username'];
	}
	
	if(isset($_POST['mysql_password']) === false){
		$validateFlag = 400;
	}
	else{
		$mysql_password = $_POST['mysql_password'];
	}
	
	if(isset($_POST['mysql_dbname']) === false){
		$validateFlag = 400;
	}
	else{
		$mysql_dbname = $_POST['mysql_dbname'];
	}
	
	if(isset($_POST['mysql_port']) === false){
		$mysql_port = 3306;
	}
	else{
		$mysql_port = $_POST['mysql_port'];
	}
	
	if(isset($_POST['mysql_socket']) === false){
		$mysql_socket = '';
	}
	else{
		$mysql_socket = $_POST['mysql_socket'];
	}
}

if($validateFlag == 200){
	if($type == 'FTP'){
		if($systemStorages_id > 0){
			if(isset($con) === false){$con = dbConnection();}
			$stmt = $con->stmt_init();
			$stmt->prepare("
				UPDATE
					`c0`.`systemStorages`
				SET
					`c0`.`systemStorages`.`connectionStatus` = 1
				WHERE
					`c0`.`systemStorages`.`id` = ?
			");
			$stmt->bind_param('i', $systemStorages_id);
			$stmt->execute();
			setTableVersion('systemStorages');
		}
		
		echo 200;
	}
	else if($type == 'FTPS'){
		if($systemStorages_id > 0){
			if(isset($con) === false){$con = dbConnection();}
			$stmt = $con->stmt_init();
			$stmt->prepare("
				UPDATE
					`c0`.`systemStorages`
				SET
					`c0`.`systemStorages`.`connectionStatus` = 1
				WHERE
					`c0`.`systemStorages`.`id` = ?
			");
			$stmt->bind_param('i', $systemStorages_id);
			$stmt->execute();
			setTableVersion('systemStorages');
		}
		
		echo 200;
	}
	else if($type == 'MySQL 8.0'){
		$conExternal = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_dbname, $mysql_port, $mysql_socket);
		
		if($conExternal -> connect_errno){
			if($systemStorages_id > 0){
				if(isset($con) === false){$con = dbConnection();}
				$stmt = $con->stmt_init();
				$stmt->prepare("
					UPDATE
						`c0`.`systemStorages`
					SET
						`c0`.`systemStorages`.`connectionStatus` = 0
					WHERE
						`c0`.`systemStorages`.`id` = ?
				");
				$stmt->bind_param('i', $systemStorages_id);
				$stmt->execute();
				setTableVersion('systemStorages');
			}
			
			echo 401;
		}
		else{
			$conExternal->close();
			
			if($systemStorages_id > 0){
				if(isset($con) === false){$con = dbConnection();}
				$stmt = $con->stmt_init();
				$stmt->prepare("
					UPDATE
						`c0`.`systemStorages`
					SET
						`c0`.`systemStorages`.`connectionStatus` = 1
					WHERE
						`c0`.`systemStorages`.`id` = ?
				");
				$stmt->bind_param('i', $systemStorages_id);
				$stmt->execute();
				setTableVersion('systemStorages');
			}
			
			echo 200;
		}
	}
	
	if(getSystemConfigurations('logSystemStorages') == 1 || getSystemConfigurations('logSystemStorages') == -1){
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
	echo 400;
	
	if(getSystemConfigurations('logSystemStorages') == 1 || getSystemConfigurations('logSystemStorages') == -1){
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
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>