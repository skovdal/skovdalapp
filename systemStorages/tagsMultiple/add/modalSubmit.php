<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

$configuration_logSystemUsers = getSystemConfigurations('logSystemUsers');
if($configuration_logSystemUsers == -1){
	$validateFlag = 400;
}

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if(isset($_POST['systemUsers_id']) === false){
	$validateFlag = 400;
}
else{
	$systemUsers_id = $_POST['systemUsers_id'];
	$systemUsers_id_array = explode(',', $systemUsers_id);
	
	foreach($systemUsers_id_array as $systemUsers_id){
		if(decodeId($systemUsers_id) == -1){
			$validateFlag = 400;
		}
		else{
			$systemUsers_id = decodeId($systemUsers_id);
			
			if(isset($systemUsers_ids) === false){
				$systemUsers_ids = $systemUsers_id;
			}
			else{
				$systemUsers_ids = $systemUsers_ids . ',' . $systemUsers_id;
			}
		}
	}
	$systemUsers_id = $systemUsers_ids;
	$systemUsers_id_array = explode(',', $systemUsers_id);
}

if(isset($_POST['name']) === false){
	$validateFlag = 400;
}
else{
	$name = $_POST['name'];
	if(strlen($name) < 3){
		$validateFlag = 400;
	}
}

if(isset($_POST['borderColor']) === false){
	$validateFlag = 400;
}
else{
	$borderColor = $_POST['borderColor'];
	if(strlen($borderColor) < 3){
		$validateFlag = 400;
	}
}

if(isset($_POST['backgroundColor']) === false){
	$validateFlag = 400;
}
else{
	$backgroundColor = $_POST['backgroundColor'];
	if(strlen($backgroundColor) < 3){
		$validateFlag = 400;
	}
}

if(isset($_POST['fontColor']) === false){
	$validateFlag = 400;
}
else{
	$fontColor = $_POST['fontColor'];
	if(strlen($fontColor) < 3){
		$validateFlag = 400;
	}
}

if($validateFlag == 200){
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
		SELECT
			`c0`.`tags`.`id` AS `tags_id`
		FROM
			`c0`.`tags`
		WHERE
			`c0`.`tags`.`name` = ?
			AND
			`c0`.`tags`.`borderColor` = ?
			AND
			`c0`.`tags`.`backgroundColor` = ?
			AND
			`c0`.`tags`.`fontColor` = ?
		LIMIT 1
	");
	$stmt->bind_param('ssss', $name, $borderColor, $backgroundColor, $fontColor);
	$stmt->execute();
	$result = $stmt->get_result();
	
	if(mysqli_num_rows($result) == 0){
		$tags_id = 0;
	}
	else{
		while($row = mysqli_fetch_assoc($result)){
			$tags_id = $row['tags_id'];
		}
	}
	$result->close();
		
	if($tags_id == 0){
		if(isset($con) === false){$con = dbConnection();}
		$stmt = $con->stmt_init();
		$stmt->prepare("
			INSERT INTO
				`c0`.`tags`
			(
				`c0`.`tags`.`name`,
				`c0`.`tags`.`borderColor`,
				`c0`.`tags`.`backgroundColor`,
				`c0`.`tags`.`fontColor`
			)
			VALUES
			(
				?,
				?,
				?,
				?
			)
		");
		$stmt->bind_param('ssss', $name, $borderColor, $backgroundColor, $fontColor);
		$stmt->execute();
		$tags_id = mysqli_insert_id($con);
		setTableVersion('tags');
	}

	foreach($systemUsers_id_array as $systemUsers_id){
		if(isset($con) === false){$con = dbConnection();}
		$stmt = $con->stmt_init();
		$stmt->prepare("
			UPDATE
				`s0`.`tagsReferences`
			SET
				`s0`.`tagsReferences`.`legacyFlag` = 1
			WHERE
				`s0`.`tagsReferences`.`tags_id` = ?
				AND
				`s0`.`tagsReferences`.`systemUsers_id` = ?
		");
		$stmt->bind_param('ii', $tags_id, $systemUsers_id);
		$stmt->execute();
		setTableVersion('tagsReferences');
			
		if(isset($con) === false){$con = dbConnection();}
		$stmt = $con->stmt_init();
		$stmt->prepare("
			INSERT INTO
				`s0`.`tagsReferences`
			(
				`s0`.`tagsReferences`.`tags_id`,
				`s0`.`tagsReferences`.`systemUsers_id`
			)
			VALUES
			(
				?,
				?
			)
		");
		$stmt->bind_param('ii', $tags_id, $systemUsers_id);
		$stmt->execute();
		setTableVersion('tagsReferences');
	}
	?>
	<script>
		parent.datatableUpdate('', 'datatable1', 0);
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();
		parent.toastr('success', 'Tilføj mærke på markerede systembrugere', 'Mærket blev tilføjet på de markerede systembrugere.', 0, true, '');
	</script>
	<?php
	if(getSystemConfigurations('logSystemUsers') == 1 || getSystemConfigurations('logSystemUsers') == -1){
		$type = 'add';
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
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> input[type="submit"]')[0].disabled = false;
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> input[type="submit"]')[0].value = 'Tilføj';
		parent.toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?1234-ABCD-5678-EFGH');
	</script>
	<?php
	if(getSystemConfigurations('logSystemUsers') == 1 || getSystemConfigurations('logSystemUsers') == -1){
		$type = 'add';
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