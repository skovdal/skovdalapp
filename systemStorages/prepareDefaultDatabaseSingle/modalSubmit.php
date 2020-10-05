<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if(isset($_POST['systemStorages_id']) === false){
	$validateFlag = 400;
}
else{
	$systemStorages_id = $_POST['systemStorages_id'];
	if(decodeId($systemStorages_id) == -1){
		$validateFlag = 400;
	}
	else{
		$systemStorages_id = decodeId($systemStorages_id);
	}
}

if(isset($con) === false){$con = dbConnection();}
$stmt = $con->stmt_init();
$stmt->prepare("
	SELECT
		`c0`.`systemStorages`.`mysql_host` AS `systemStorages_mysql_host`,
		`c0`.`systemStorages`.`mysql_username` AS `systemStorages_mysql_username`,
		`c0`.`systemStorages`.`mysql_password` AS `systemStorages_mysql_password`,
		`c0`.`systemStorages`.`mysql_dbname` AS `systemStorages_mysql_dbname`,
		`c0`.`systemStorages`.`mysql_port` AS `systemStorages_mysql_port`,
		`c0`.`systemStorages`.`mysql_socket` AS `systemStorages_mysql_socket`
	FROM
		`c0`.`systemStorages`
	WHERE
		`c0`.`systemStorages`.`id` = ?
	LIMIT 1
");
$stmt->bind_param('i', $systemStorages_id);
$stmt->execute();
$result = $stmt->get_result();

if(mysqli_num_rows($result) == 0){
	$validateFlag = 400;
	$errorMessages_id = 4;
}
else{
	while($row = mysqli_fetch_assoc($result)){
		$systemStorages_mysql_host = $row['systemStorages_mysql_host'];
		$systemStorages_mysql_username = $row['systemStorages_mysql_username'];
		$systemStorages_mysql_password = $row['systemStorages_mysql_password'];
		$systemStorages_mysql_dbname = $row['systemStorages_mysql_dbname'];
		$systemStorages_mysql_port = $row['systemStorages_mysql_port'];
		$systemStorages_mysql_socket = $row['systemStorages_mysql_socket'];
	}
}
$result->close();

if($validateFlag == 200){
	$conExternal = new mysqli($systemStorages_mysql_host, $systemStorages_mysql_username, $systemStorages_mysql_password, $systemStorages_mysql_dbname, $systemStorages_mysql_port, $systemStorages_mysql_socket);
	
	$stmtExternal = $conExternal->stmt_init();
	$stmtExternal->prepare("
		SET NAMES utf8mb4;
	");
	$stmtExternal->execute();
	
	$stmtExternal = $conExternal->stmt_init();
	$stmtExternal->prepare("
		SET FOREIGN_KEY_CHECKS = 0;
	");
	$stmtExternal->execute();
	
	$stmtExternal = $conExternal->stmt_init();
	$stmtExternal->prepare("
		DROP TABLE IF EXISTS `devices`;
	");
	$stmtExternal->execute();
	
	$stmtExternal = $conExternal->stmt_init();
	$stmtExternal->prepare("
		CREATE TABLE `devices` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `type` varchar(255) DEFAULT NULL,
		  `name` varchar(255) DEFAULT NULL,
		  `name2` varchar(255) DEFAULT NULL,
		  `cvrNumber` varchar(255) DEFAULT NULL,
		  `cprNumber` varchar(255) DEFAULT NULL,
		  `address` varchar(255) DEFAULT NULL,
		  `address2` varchar(255) DEFAULT NULL,
		  `zipCode` varchar(255) DEFAULT NULL,
		  `city` varchar(255) DEFAULT NULL,
		  `country` varchar(255) DEFAULT NULL,
		  `phone` varchar(255) DEFAULT NULL,
		  `phone2` varchar(255) DEFAULT NULL,
		  `email` varchar(255) DEFAULT NULL,
		  `email2` varchar(255) DEFAULT NULL,
		  `dawaAddress` varchar(255) DEFAULT NULL,
		  `deleteFlag` bit(1) DEFAULT NULL,
		  `legacyFlag` bit(1) DEFAULT NULL,
		  `tempFlag` bit(1) DEFAULT NULL,
		  `emailVerified` bit(1) DEFAULT NULL,
		  `email2Verified` bit(1) DEFAULT NULL,
		  `phoneVerified` bit(1) DEFAULT NULL,
		  `phone2Verified` bit(1) DEFAULT NULL,
		  `addressVerified` bit(1) DEFAULT NULL,
		  `dawaAddressVerified` bit(1) DEFAULT NULL,
		  PRIMARY KEY (`id`)
		) /*!50100 TABLESPACE `innodb_system` */ ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
	");
// 	$stmtExternal->bind_param('i', $systemStorages_id);
	$stmtExternal->execute();
	
	$conExternal->close();
	?>
	<script>
		parent.datatableUpdate('', 'datatable1', 0);
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();
		parent.toastr('success', 'Klargør systemlager som standarddatabase', 'Systemlageret til klargjort som standarddatabase.', 0, true, '');
	</script>
	<?php
	if(getSystemConfigurations('logSystemStorages') == 1 || getSystemConfigurations('logSystemStorages') == -1){
		$type = 'delete';
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
?>
	<script>
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> input.delete[type="submit"]')[0].disabled = false;
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> input.delete[type="submit"]')[0].value = 'Klargør systemlager som standarddatabase';
		parent.toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?1234-ABCD-5678-EFGH');
	</script>
	<?php
	if(getSystemConfigurations('logSystemStorages') == 1 || getSystemConfigurations('logSystemStorages') == -1){
		$type = 'delete';
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