<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if(isset($_POST['refererModalId']) === false){
	$validateFlag = 400;
}
else{
	$refererModalId = $_POST['refererModalId'];
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

$microtimeForTagId = microtime(true);

if($validateFlag == 200){
?>
	<script>
		parent.document.querySelectorAll('#modal-<?php echo purify($refererModalId); ?> div.tagTab')[0].insertAdjacentHTML('beforeend', '<input data-backgroundColor="<?php echo purify($backgroundColor); ?>" data-fontColor="<?php echo purify($fontColor); ?>" data-borderColor="<?php echo purify($borderColor); ?>" name="tag-name-<?php echo purify($refererModalId) . '-' . purify($microtimeForTagId); ?>" type="hidden" value="<?php echo purify($name); ?>">');
		parent.document.querySelectorAll('#modal-<?php echo purify($refererModalId); ?> div.tagTab')[0].insertAdjacentHTML('beforeend', '<input data-backgroundColor="<?php echo purify($backgroundColor); ?>" data-fontColor="<?php echo purify($fontColor); ?>" data-borderColor="<?php echo purify($borderColor); ?>" name="tag-borderColor-<?php echo purify($refererModalId) . '-' . purify($microtimeForTagId); ?>" type="hidden" value="<?php echo purify($borderColor); ?>">');
		parent.document.querySelectorAll('#modal-<?php echo purify($refererModalId); ?> div.tagTab')[0].insertAdjacentHTML('beforeend', '<input data-backgroundColor="<?php echo purify($backgroundColor); ?>" data-fontColor="<?php echo purify($fontColor); ?>" data-borderColor="<?php echo purify($borderColor); ?>" name="tag-backgroundColor-<?php echo purify($refererModalId) . '-' . purify($microtimeForTagId); ?>" type="hidden" value="<?php echo purify($backgroundColor); ?>">');
		parent.document.querySelectorAll('#modal-<?php echo purify($refererModalId); ?> div.tagTab')[0].insertAdjacentHTML('beforeend', '<input data-backgroundColor="<?php echo purify($backgroundColor); ?>" data-fontColor="<?php echo purify($fontColor); ?>" data-borderColor="<?php echo purify($borderColor); ?>" name="tag-fontColor-<?php echo purify($refererModalId) . '-' . purify($microtimeForTagId); ?>" type="hidden" value="<?php echo purify($fontColor); ?>">');
		parent.modalGenerateTags('<?php echo purify($refererModalId); ?>');
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();
	</script>
	<?php
	if(getSystemConfigurations('logIdidentities') == 1 || getSystemConfigurations('logIdidentities') == -1){
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
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> input[type="submit"]')[0].value = 'Tilføj';
		parent.toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?1234-ABCD-5678-EFGH');
	</script>
	<?php
	if(getSystemConfigurations('logIdidentities') == 1 || getSystemConfigurations('logIdidentities') == -1){
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