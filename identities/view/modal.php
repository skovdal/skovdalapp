<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if(isset($_POST['identities_id']) === false){
	$validateFlag = 400;
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
		`c0`.`identities`.`type` AS `identities_type`,
		`c0`.`identities`.`name` AS `identities_name`,
		`c0`.`identities`.`name2` AS `identities_name2`,
		`c0`.`identities`.`cvrNumber` AS `identities_cvrNumber`,
		`c0`.`identities`.`cprNumber` AS `identities_cprNumber`,
		`c0`.`identities`.`address` AS `identities_address`,
		`c0`.`identities`.`address2` AS `identities_address2`,
		`c0`.`identities`.`zipCode` AS `identities_zipCode`,
		`c0`.`identities`.`city` AS `identities_city`,
		`c0`.`identities`.`country` AS `identities_country`,
		`c0`.`identities`.`phone` AS `identities_phone`,
		`c0`.`identities`.`phone2` AS `identities_phone2`,
		`c0`.`identities`.`email` AS `identities_email`,
		`c0`.`identities`.`email2` AS `identities_email2`,
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
}
else{
	while($row = mysqli_fetch_assoc($result)){
		$identities_type = $row['identities_type'];
		$identities_name = $row['identities_name'];
		$identities_name2 = $row['identities_name2'];
		$identities_cvrNumber = $row['identities_cvrNumber'];
		$identities_cprNumber = $row['identities_cprNumber'];
		$identities_address = $row['identities_address'];
		$identities_address2 = $row['identities_address2'];
		$identities_zipCode = $row['identities_zipCode'];
		$identities_city = $row['identities_city'];
		$identities_country = $row['identities_country'];
		$identities_phone = $row['identities_phone'];
		$identities_phone2 = $row['identities_phone2'];
		$identities_email = $row['identities_email'];
		$identities_email2 = $row['identities_email2'];
		$identities_photo_filesMetaData_id = $row['identities_photo_filesMetaData_id'];
		
		if($identities_photo_filesMetaData_id === null){
			$identities_photoUrl = '/images/svgImage.php?id=' . urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/user-circle.svg') . '&fill=' . urlencode('rgba(135,140,145,1)');
		}
		else{
			$identities_photoUrl = '/serve/photo.php?id=' . $identities_photo_filesMetaData_id;
		}
	}
}
$result->close();

if($validateFlag == 200){
?>
	<h1><?php echo purify($identities_name); ?></h1>
	<ul>
		<li class="active" onclick="modalTab('<?php echo purify($modalId); ?>', 1);">
			Generelt
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 2);">
			Adresse
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 3);">
			Kontakt
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 4);">
			Mærker
		</li>
	</ul>
	<form onsubmit="return false;">
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="photo" style="background-image:url('<?php echo purify($identities_photoUrl); ?>');"></div>
			<input class="photo" type="text" value="<?php echo purify($identities_type); ?>" readonly><label>Type</label><br>
			<input class="photo" type="text" value="<?php echo purify($identities_name); ?>" readonly><label>Navn</label><br>
			<input class="photo" type="text" value="<?php echo purify($identities_name2); ?>" readonly><label>Supplerende navneoplysninger</label><br>
			<input type="text" value="<?php echo purify($identities_cvrNumber); ?>" readonly><label>CVR-nummer</label><br>
			<input type="text" value="<?php echo purify($identities_cprNumber); ?>" readonly><label>CPR-nummer</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input type="text" value="<?php echo purify($identities_address); ?>" readonly><label>Adresse</label><br>
			<input type="text" value="<?php echo purify($identities_address2); ?>" readonly><label>Supplerende adresseoplysninger</label><br>
			<input type="text" value="<?php echo purify($identities_zipCode); ?>" readonly><label>Postnummer</label><br>
			<input type="text" value="<?php echo purify($identities_city); ?>" readonly><label>By</label><br>
			<input type="text" value="<?php echo purify($identities_country); ?>" readonly><label>Land</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input type="text" value="<?php echo purify($identities_phone); ?>" readonly><label>Telefon</label><br>
			<input type="text" value="<?php echo purify($identities_phone2); ?>" readonly><label>Sekundær telefon</label><br>
			<input type="text" value="<?php echo purify($identities_email); ?>" readonly><label>E-mail</label><br>
			<input type="text" value="<?php echo purify($identities_email2); ?>" readonly><label>Sekundær e-mail</label><br>
		</div>
		
		<div class="tagTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="tagContainer">
				<?php
				if(isset($con) === false){$con = dbConnection();}
				$stmt = $con->stmt_init();
				$stmt->prepare("
					SELECT
						`s0`.`tagsReferences`.`id` AS `tagsReferences_id`,
						`c0`.`tags`.`name` AS `tags_name`,
						`c0`.`tags`.`borderColor` AS `tags_borderColor`,
						`c0`.`tags`.`backgroundColor` AS `tags_backgroundColor`,
						`c0`.`tags`.`fontColor` AS `tags_fontColor`
					FROM
						`s0`.`tagsReferences`
					INNER JOIN
						`c0`.`tags`
					ON
						`s0`.`tagsReferences`.`tags_id` = `c0`.`tags`.`id`
					WHERE
						`s0`.`tagsReferences`.`deleteFlag` IS NULL
						AND
						`s0`.`tagsReferences`.`tempFlag` IS NULL
						AND
						`s0`.`tagsReferences`.`legacyFlag` IS NULL
						AND
						`s0`.`tagsReferences`.`identities_id` = ?
					ORDER BY
						`c0`.`tags`.`name` ASC
				");
				$stmt->bind_param('i', $identities_id);
				$stmt->execute();
				$result = $stmt->get_result();
				
				if(mysqli_num_rows($result) == 0){
					echo '<div class="noContent"><br><br><br><br><br><br><br><br><br>Der er ikke tilføjet nogen mærker</div>';
				}
				else{
					while($row = mysqli_fetch_assoc($result)){
						echo '<div class="tag" style="background-color:' . purify($row['tags_backgroundColor']) . '; background-image:none; border:1px solid ' . purify($row['tags_borderColor']) . '; color:' . purify($row['tags_fontColor']) . '; cursor:default; padding:3px 9px 3px 9px;">' . purify($row['tags_name']) . '</div>';
					}
				}
				$result->close();
				?>
			</div>
		</div>
		
		<div class="buttons">
			<input class="delete" onclick="modal(0, 'basic', '/identities/view/delete/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>&identities_id=<?php echo encodeId(purify($identities_id)); ?>', true, 1);" type="button" value="Slet identitet"><input class="edit" onclick="modal(<?php echo purify($modalId); ?>, 'large', '/identities/edit/modal.php', 'POST', '&identities_id=<?php echo encodeId(purify($identities_id)); ?>', false, 0)" type="button" value="Editer identitet"><input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk">
		</div>
	</form>
	<?php
	if(getSystemConfigurations('logIdidentities') == 1 || getSystemConfigurations('logIdidentities') == -1){
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
	if(getSystemConfigurations('logIdidentities') == 1 || getSystemConfigurations('logIdidentities') == -1){
		$addSystemEventType = 'view';
		$addSystemEventSystemUsers_id = $_SESSION['systemUsers_id'];
		$addSystemEventIpAddress = $_SERVER['REMOTE_ADDR'];
		$addSystemEventStartTime = $systemEvents_addEvent_startTime;
		$addSystemEventEndTime = microtime(true);
		$addSystemEventLatency = ($endTime - $startTime);
		$addSystemEventFinished = 0;
		$addSystemEventHost = $_SERVER['SERVER_NAME'];
		$addSystemEventHttpVersion = $_SERVER['SERVER_PROTOCOL'];
		$addSystemEventInstanceId = session_id();
		$addSystemEventMethod = $_SERVER['REQUEST_METHOD'];
		$addSystemEventStatus = $validateFlag;
		$addSystemEventUserAgent = $_SERVER['HTTP_USER_AGENT'];
		$addSystemEventVersion = date('YmdHisu', filemtime(__FILE__));
		$addSystemEventPostData = json_encode($_POST);
		$addSystemEventGetData = json_encode($_GET);
		$addSystemEventHttpsEnabled = $_SERVER['HTTPS'];
		$addSystemEventFileName = $_SERVER['SCRIPT_FILENAME'];
		
		$addSystemEventDevices_id = null;
		$addSystemEventExports_id = null;
		$addSystemEventFilescontent_id = null;
		$addSystemEventFilesmetadata_id = null;
		$addSystemEventIdentities_id = $identities_id;
		$addSystemEventMeetings_id = null;
		$addSystemEventPolicies_id = null;
		$addSystemEventProcessingactivities_id = null;
		$addSystemEventProcessingactivitieslegasbasises_id = null;
		$addSystemEventProgresstime_id = null;
		$addSystemEventPseudonames_id = null;
		$addSystemEventSessions_id = null;
		$addSystemEventSystemconfigurations_id = null;
		$addSystemEventSystemevents_id = null;
		$addSystemEventSystemnotifications_id = null;
		$addSystemEventSystemstorages_id = null;
		$addSystemEventSystemUsers_id = null;
		$addSystemEventSystemuserssystempreferences_id = null;
		$addSystemEventTableversions_id = null;
		$addSystemEventTags_id = null;
		$addSystemEventTagsreferences_id = null;
		
		addSystemEvent(
			$addSystemEventSystemUsers_id,
			$addSystemEventType,
			$addSystemEventIpAddress,
			$addSystemEventStartTime,
			$addSystemEventEndTime,
			$addSystemEventFinished,
			$addSystemEventHost,
			$addSystemEventHttpVersion,
			$addSystemEventInstanceId,
			$addSystemEventMethod,
			$addSystemEventStatus,
			$addSystemEventUserAgent,
			$addSystemEventVersion,
			$addSystemEventPostData,
			$addSystemEventGetData,
			$addSystemEventHttpsEnabled,
			$addSystemEventFileName,
			$addSystemEventDevices_id,
			$addSystemEventExports_id,
			$addSystemEventFilescontent_id,
			$addSystemEventFilesmetadata_id,
			$addSystemEventIdentities_id,
			$addSystemEventMeetings_id,
			$addSystemEventPolicies_id,
			$addSystemEventProcessingactivities_id,
			$addSystemEventProcessingactivitieslegasbasises_id,
			$addSystemEventProgresstime_id,
			$addSystemEventPseudonames_id,
			$addSystemEventSessions_id,
			$addSystemEventSystemconfigurations_id,
			$addSystemEventSystemevents_id,
			$addSystemEventSystemnotifications_id,
			$addSystemEventSystemstorages_id,
			$addSystemEventSystemUsers_id,
			$addSystemEventSystemuserssystempreferences_id,
			$addSystemEventTableversions_id,
			$addSystemEventTags_id,
			$addSystemEventTagsreferences_id
		);
	}
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>