<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

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
	if(decodeId($systemUsers_id) == -1){
		$validateFlag = 400;
	}
	else{
		$systemUsers_id = decodeId($systemUsers_id);
	}
}

if(isset($con) === false){$con = dbConnection();}
$stmt = $con->stmt_init();
$stmt->prepare("
	SELECT
		`c0`.`systemUsers`.`name` AS `systemUsers_name`,
		`c0`.`systemUsers`.`securityClearance` AS `systemUsers_securityClearance`,
		`c0`.`systemUsers`.`blockSignIn` AS `systemUsers_blockSignIn`,
		`c0`.`systemUsers`.`userMustChangePasswordAtNextSignIn` AS `systemUsers_userMustChangePasswordAtNextSignIn`,
		`c0`.`systemUsers`.`forceUseOfMultifactorAuthentication` AS `systemUsers_forceUseOfMultifactorAuthentication`,
		`c0`.`systemUsers`.`identities_id` AS `systemUsers_identities_id`
	FROM
		`c0`.`systemUsers`
	WHERE
		`c0`.`systemUsers`.`id` = ?
	LIMIT 1
");
$stmt->bind_param('i', $systemUsers_id);
$stmt->execute();
$result = $stmt->get_result();

if(mysqli_num_rows($result) == 0){
	$validateFlag = 400;
}
else{
	while($row = mysqli_fetch_assoc($result)){
		$systemUsers_name = $row['systemUsers_name'];
		$systemUsers_securityClearance = $row['systemUsers_securityClearance'];
		$systemUsers_blockSignIn = $row['systemUsers_blockSignIn'];
		$systemUsers_userMustChangePasswordAtNextSignIn = $row['systemUsers_userMustChangePasswordAtNextSignIn'];
		$systemUsers_forceUseOfMultifactorAuthentication = $row['systemUsers_forceUseOfMultifactorAuthentication'];
		$systemUsers_identities_id = $row['systemUsers_identities_id'];
	}
}
$result->close();

if(isset($con) === false){$con = dbConnection();}
$stmt = $con->stmt_init();
$stmt->prepare("
	SELECT
		`c0`.`identities`.`type` AS `identities_type`,
		`c0`.`identities`.`name` AS `identities_name`,
		`c0`.`identities`.`name2` AS `identities_name2`,
		`c0`.`identities`.`phone` AS `identities_phone`,
		`c0`.`identities`.`email` AS `identities_email`,
		`c0`.`identities`.`securityClearance` AS `identities_securityClearance`,
		`c0`.`identities`.`photo_filesMetaData_id` AS `identities_photo_filesMetaData_id`
	FROM
		`c0`.`identities`
	WHERE
		`c0`.`identities`.`id` = ?
	LIMIT 1
");
$stmt->bind_param('i', $systemUsers_identities_id);
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
		$identities_phone = $row['identities_phone'];
		$identities_email = $row['identities_email'];
		$identities_securityClearance = $row['identities_securityClearance'];
		$identities_photo_filesMetaData_id = $row['identities_photo_filesMetaData_id'];
		
		if($identities_photo_filesMetaData_id === null){
			$identities_photoUrl = '/images/svgImage.php?id=' . urlencode('/images/fontawesome-pro-5.9.0-web/svgs/solid/user-circle.svg') . '&fill=' . urlencode('rgba(135,140,145,1)');
		}
		else{
			$identities_photoUrl = '/serve/photo.php?id=' . encodeId($identities_photo_filesMetaData_id);
		}
	}
}
$result->close();

if($validateFlag == 200){
?>
	<h1><?php echo purify($systemUsers_name); ?></h1>
	<ul>
		<li class="active" onclick="modalTab('<?php echo purify($modalId); ?>', 1);">
			Generelt
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 2);">
			Identitet
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 3);">
			Roller
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 4);">
			Grupper
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 5);">
			Logbog
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 6);">
			Mærker
		</li>
	</ul>
	<form onsubmit="return false;">
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input type="text" value="<?php echo purify($systemUsers_name); ?>" readonly><label>Navn</label><br>
			<input type="text" value="<?php echo purify($systemUsers_securityClearance); ?>" readonly><label>Sikkerhedsgodkendelse</label><br>
			<div class="checkbox <?php if($systemUsers_blockSignIn == 1){echo 'checked';}else{echo 'unchecked';} ?>"><label for="inputBlockSignIn">Bloker log ind</label></div><br>
			<div class="checkbox <?php if($systemUsers_userMustChangePasswordAtNextSignIn == 1){echo 'checked';}else{echo 'unchecked';} ?>"><label for="inputUserMustChangePasswordAtNextSignIn">Brugeren skal ændre adgangskode ved næste log ind</label></div><br>
			<div class="checkbox <?php if($systemUsers_forceUseOfMultifactorAuthentication == 1){echo 'checked';}else{echo 'unchecked';} ?>"><label for="inputForceUseOfMultifactorAuthentication">Gennemtving brug af flerfaktorautentificering</label></div><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="photo" style="background-image:url('<?php echo purify($identities_photoUrl); ?>');"></div>
			<input class="photo" type="text" value="<?php echo purify($identities_type); ?>" readonly><label>Type</label><br>
			<input class="photo" type="text" value="<?php echo purify($identities_name); ?>" readonly><label>Navn</label><br>
			<input class="photo" type="text" value="<?php echo purify($identities_name2); ?>" readonly><label>Supplerende navneoplysninger</label><br>
			<input type="text" value="<?php echo purify($identities_phone); ?>" readonly><label>Telefon</label><br>
			<input type="text" value="<?php echo purify($identities_email); ?>" readonly><label>E-mail</label><br>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fusers-crown.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					Der er ikke tilføjet nogen roller
				</div>
			</div>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fusers-class.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					Der er ikke tilføjet nogen grupper
				</div>
			</div>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fbars.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					Der er ikke registreret nogen hændelser
				</div>
			</div>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fbars.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					Der er ikke registreret nogen hændelser
				</div>
			</div>
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
						`s0`.`tagsReferences`.`systemUsers_id` = ?
					ORDER BY
						`c0`.`tags`.`name` ASC
				");
				$stmt->bind_param('i', $systemUsers_id);
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
			<input class="delete" onclick="modal(0, 'basic', '/systemUsers/view/delete/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>&systemUsers_id=<?php echo encodeId(purify($systemUsers_id)); ?>', true, 1);" type="button" value="Slet systembruger"><input class="edit" onclick="modal(<?php echo purify($modalId); ?>, 'large', '/systemUsers/edit/modal.php', 'POST', '&systemUsers_id=<?php echo encodeId(purify($systemUsers_id)); ?>', false, 0)" type="button" value="Editer systembruger"><input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk">
		</div>
	</form>
	<?php
	if(getSystemConfigurations('logSystemUsers') == 1 || getSystemConfigurations('logSystemUsers') == -1){
		$type = 'view';
		$trigger_systemUsers_id = $_SESSION['systemUsers_id'];
		$ipAddress = $_SERVER['REMOTE_ADDR'];
		$startTime = $systemEvents_addEvent_startTime;
		$endTime = microtime(true);
		$finished = 1;
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
		$systemUsers_id = $systemUsers_id;
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
	if(getSystemConfigurations('logSystemUsers') == 1 || getSystemConfigurations('logSystemUsers') == -1){
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
		$systemUsers_id = $systemUsers_id;
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