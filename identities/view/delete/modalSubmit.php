<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
	$validateFlagType = 'danger';
	$validateFlagTitle = 'Der er opstået en fejl!';
	$validateFlagMsg = 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...';
	$validateFlagToastrId = 0;
	$validateFlagRegister = true;
	$validateFlagOpenUrl = 'https://errors.complian.app.complian.dev?20';
}
else{
	$modalId = $_POST['modalId'];
}

if(isset($_POST['refererModalId']) === false){
	$validateFlag = 400;
	$validateFlagType = 'danger';
	$validateFlagTitle = 'Der er opstået en fejl!';
	$validateFlagMsg = 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...';
	$validateFlagToastrId = 0;
	$validateFlagRegister = true;
	$validateFlagOpenUrl = 'https://errors.complian.app.complian.dev?21';
}
else{
	$refererModalId = $_POST['refererModalId'];
}

if(isset($_POST['confirmationCode']) === false){
// 	$validateFlag = 400;
}
else{
	$confirmationCode = $_POST['confirmationCode'];
}

if(isset($_POST['password']) === false){
// 	$validateFlag = 400;
}
else{
	$password = $_POST['password'];
}

if(isset($_POST['identities_id']) === false){
	$validateFlag = 400;
	$validateFlagType = 'danger';
	$validateFlagTitle = 'Der er opstået en fejl!';
	$validateFlagMsg = 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...';
	$validateFlagToastrId = 0;
	$validateFlagRegister = true;
	$validateFlagOpenUrl = 'https://errors.complian.app.complian.dev?22';
}
else{
	$identities_id = $_POST['identities_id'];
	if(decodeId($identities_id) == -1){
		$validateFlag = 400;
	}
	else{
		$identities_id = decodeId($identities_id);
	}
}

if(isset($con) === false){$con = dbConnection();}
$stmt = $con->stmt_init();
$stmt->prepare("
	SELECT
		`c0`.`systemUsers`.`id` AS `systemUsers_id`
	FROM
		`c0`.`systemUsers`
	WHERE
		`c0`.`systemUsers`.`identities_id` = ?
	LIMIT 1
");
$stmt->bind_param('i', $identities_id);
$stmt->execute();
$result = $stmt->get_result();

if(mysqli_num_rows($result) > 0){
	$validateFlag = 400;
	$validateFlagType = 'warning';
	$validateFlagTitle = 'Slet identitet';
	$validateFlagMsg = 'Det er desværre ikke muligt at slette identiteten, da den er tilknyttet en systembruger.<br><br>Fjern venligst tilknytningen for at slette identiteten.';
	$validateFlagToastrId = 0;
	$validateFlagRegister = true;
	$validateFlagOpenUrl = '';
}
$result->close();

		if(isset($con) === false){$con = dbConnection();}
		$stmt = $con->stmt_init();
$stmt->prepare("
	SELECT
		`c0`.`identities`.`photo_filesMetaData_id` AS `identities_photo_filesMetaData_id`
	FROM
		`c0`.`identities`
	WHERE
		`c0`.`identities`.`id` = ?
	LIMIT 1
");
$stmt->bind_param('i', $identities_id);
$stmt->execute();
$result = $stmt->get_result();

if(mysqli_num_rows($result) == 0){
	$validateFlag = 400;
	$validateFlagType = 'danger';
	$validateFlagTitle = 'Der er opstået en fejl!';
	$validateFlagMsg = 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...';
	$validateFlagToastrId = 0;
	$validateFlagRegister = true;
	$validateFlagOpenUrl = 'https://errors.complian.app.complian.dev?23';
}
else{
	while($row = mysqli_fetch_assoc($result)){
		$identities_photo_filesMetaData_id = $row['identities_photo_filesMetaData_id'];
	}
}
$result->close();

if(isset($con) === false){$con = dbConnection();}
$stmt = $con->stmt_init();
$stmt->prepare("
	SELECT
		`c0`.`filesMetaData`.`id` AS `filesMetaData_id`,
		`c0`.`filesMetaData`.`filesContent_id` AS `filesMetaData_filesContent_id`
	FROM
		`c0`.`filesMetaData`
	WHERE
		`c0`.`filesMetaData`.`id` = ?
	LIMIT 1
");
$stmt->bind_param('i', $identities_photo_filesMetaData_id);
$stmt->execute();
$result = $stmt->get_result();

if(mysqli_num_rows($result) == 0){
	$filesMetaData_id = 0;
	$filesMetaData_filesContent_id = 0;
}
else{
	while($row = mysqli_fetch_assoc($result)){
		$filesMetaData_id = $row['filesMetaData_id'];
		$filesMetaData_filesContent_id = $row['filesMetaData_filesContent_id'];
	}
}
$result->close();

if($validateFlag == 200){
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
		UPDATE
			`c0`.`identities`
		SET
			`c0`.`identities`.`deleteFlag` = 1
		WHERE
			`c0`.`identities`.`id` = ?
		LIMIT 1
	");
	$stmt->bind_param('i', $identities_id);
	$stmt->execute();
	setTableVersion('identities');
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
		UPDATE
			`c0`.`filesMetaData`
		SET
			`c0`.`filesMetaData`.`deleteFlag` = 1
		WHERE
			`c0`.`filesMetaData`.`id` = ?
		LIMIT 1
	");
	$stmt->bind_param('i', $filesMetaData_id);
	$stmt->execute();
	setTableVersion('filesMetaData');
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
		UPDATE
			`c0`.`filesContent`
		SET
			`c0`.`filesContent`.`deleteFlag` = 1
		WHERE
			`c0`.`filesContent`.`filesMetaData_id` = ?
		LIMIT 1
	");
	$stmt->bind_param('i', $filesMetaData_filesContent_id);
	$stmt->execute();
	setTableVersion('filesContent');
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
		UPDATE
			`s0`.`tagsReferences`
		SET
			`s0`.`tagsReferences`.`deleteFlag` = 1
		WHERE
			`s0`.`tagsReferences`.`identities_id` = ?
	");
	$stmt->bind_param('i', $identities_id);
	$stmt->execute();
	setTableVersion('tagsReferences');
}

if($validateFlag == 200){
?>
	<script>
		parent.datatableUpdate('', 'datatable1', 0);
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();
		parent.document.querySelectorAll('#modal-<?php echo purify($refererModalId); ?> div.close')[0].click();
		parent.toastr('success', 'Slet identitet', 'Identiteten blev slettet.', 0, true, '');
	</script>
	<?php
	if(getSystemConfigurations('logIdidentities') == 1 || getSystemConfigurations('logIdidentities') == -1){
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
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> input.delete[type="submit"]')[0].value = 'Slet identitet';
		parent.toastr('<?php echo purify($validateFlagType); ?>', '<?php echo purify($validateFlagTitle); ?>', '<?php echo purify($validateFlagMsg); ?>', <?php echo purify($validateFlagToastrId); ?>, <?php echo purify($validateFlagRegister); ?>, '<?php echo purify($validateFlagOpenUrl); ?>');
	</script>
	<?php
	if(getSystemConfigurations('logIdidentities') == 1 || getSystemConfigurations('logIdidentities') == -1){
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