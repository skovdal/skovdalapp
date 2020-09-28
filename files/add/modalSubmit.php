<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

$configuration_logFiles = getSystemConfigurations('logFiles');
if($configuration_logFiles == -1){
	$validateFlag = 400;
}

if(isset($_GET['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_GET['modalId'];
}

if($_FILES['files']['name'][0] === null){
	$validateFlag = 400;
}
else{
	$fileCounter = count($_FILES['files']['name']);
}

if($_FILES['files']['size'][0] === null){
	$validateFlag = 400;
}

if($_FILES['files']['size'][0] === null){
	$validateFlag = 400;
}

if($_FILES['files']['type'][0] === null){
	$validateFlag = 400;
}

if($_FILES['files']['tmp_name'][0] === null){
	$validateFlag = 400;
}

if($validateFlag == 200){	
	for($i=0; $i<$fileCounter; $i++){
		if($_FILES['files']['name'][$i] === null){
			$validateFlag = 400;
		}
		else{
			$fileName = $_FILES['files']['name'][$i];
		}
		
		if($_FILES['files']['size'][$i] === null){
			$validateFlag = 400;
		}
		else{
			$fileSize = $_FILES['files']['size'][$i];
		}
		
		if($_FILES['files']['size'][$i] === null){
			$validateFlag = 400;
		}
		else{
			if($fileSize > 3000000000){
				$validateFlag = 400;
			}
			else{
				$fileSize = $_FILES['files']['size'][$i];
			}
		}
		
		if($_FILES['files']['type'][$i] === null){
			$validateFlag = 400;
		}
		else{
			$fileType = $_FILES['files']['type'][$i];
		}
		
		if($_FILES['files']['tmp_name'][$i] === null){
			$validateFlag = 400;
		}
		else{
			$fileContent = base64_encode(file_get_contents($_FILES['files']['tmp_name'][$i]));
		}
		
		if($validateFlag == 200){
			if(isset($con) === false){$con = dbConnection();}
			$stmt = $con->stmt_init();
			$stmt->prepare("
				INSERT INTO
					`c0`.`filesMetaData`
				(
					`c0`.`filesMetaData`.`type`,
					`c0`.`filesMetaData`.`name`,
					`c0`.`filesMetaData`.`size`,
					`c0`.`filesMetaData`.`lastModified`
				)
				VALUES
				(
					?,
					?,
					?,
					NOW()
				)
			");
			$stmt->bind_param('sss', $fileType, $fileName, $fileSize);
			$stmt->execute();
			$filesMetaData_id = mysqli_insert_id($con);
			setTableVersion('filesMetaData');
					
			if(isset($con) === false){$con = dbConnection();}
			$stmt = $con->stmt_init();
			$stmt->prepare("
				INSERT INTO
					`c0`.`filesContent`
				(
					`c0`.`filesContent`.`content`,
					`c0`.`filesContent`.`filesMetaData_id`
				)
				VALUES
				(
					?,
					?
				)
			");
			$stmt->bind_param('si', $fileContent, $filesMetaData_id);
			$stmt->execute();
			$filesContent_id = mysqli_insert_id($con);
			setTableVersion('filesContent');
			
			if(isset($con) === false){$con = dbConnection();}
			$stmt = $con->stmt_init();
			$stmt->prepare("
				UPDATE
					`c0`.`filesMetaData`
				SET
					`c0`.`filesMetaData`.`filesContent_id` = ?
				WHERE
					`c0`.`filesMetaData`.`id` = ?
				LIMIT 1
			");
			$stmt->bind_param('ii', $filesContent_id, $filesMetaData_id);
			$stmt->execute();
			setTableVersion('filesMetaData');
		}
	}
	?>
	<script>
		parent.datatableUpdate('', 'datatable1', 0);
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();
		parent.toastr('success', 'Nye filer', 'Filerne blev tilføjet.', 0, true, '');
	</script>
	<?php
	if(getSystemConfigurations('logFiles') == 1 || getSystemConfigurations('logFiles') == -1){
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
		for(var i = 0; i < parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> input[type="text"], #modal-<?php echo purify($modalId); ?> input[type="tel"], #modal-<?php echo purify($modalId); ?> input[type="email"], #modal-<?php echo purify($modalId); ?> input[type="number"]').length; i++){
			parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> input[type="text"], #modal-<?php echo purify($modalId); ?> input[type="tel"], #modal-<?php echo purify($modalId); ?> input[type="email"], #modal-<?php echo purify($modalId); ?> input[type="number"]')[i].readOnly = false;
		}
		
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> input[type="submit"]')[0].disabled = false;
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> input[type="submit"]')[0].value = 'Gem';
		parent.toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?1234-ABCD-5678-EFGH');
	</script>
	<?php
	if(getSystemConfigurations('logFiles') == 1 || getSystemConfigurations('logFiles') == -1){
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