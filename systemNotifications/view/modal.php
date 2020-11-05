<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if(isset($_POST['systemNotifications_id']) === false){
	$validateFlag = 400;
}
else{
	$systemNotifications_id = $_POST['systemNotifications_id'];
	if(decodeId($systemNotifications_id) == -1){
		$validateFlag = 400;
	}
	else{
		$systemNotifications_id = decodeId($systemNotifications_id);
	}
}

if(isset($con) === false){$con = dbConnection();}
$stmt = $con->stmt_init();
$stmt->prepare("
	SELECT
		`c0`.`systemNotifications`.`type` AS `systemNotifications_type`,
		`c0`.`systemNotifications`.`title` AS `systemNotifications_title`,
		`c0`.`systemNotifications`.`msg` AS `systemNotifications_msg`,
		`c0`.`systemNotifications`.`users_id` AS `systemNotifications_users_id`,
		DATE_FORMAT(`c0`.`systemNotifications`.`date`, '%d-%m-%Y %H:%i:%s') AS `systemNotifications_date`,
		`c0`.`systemNotifications`.`ipAddress` AS `systemNotifications_ipAddress`,
		(
			SELECT
				`c0`.`systemUsers`.`name`
			FROM
				`c0`.`systemUsers`
			WHERE
				`c0`.`systemUsers`.`id` = `systemNotifications_users_id`
		) AS `systemUsers_name`
	FROM
		`c0`.`systemNotifications`
	WHERE
		`c0`.`systemNotifications`.`id` = ?
	LIMIT 1
");
$stmt->bind_param('i', $systemNotifications_id);
$stmt->execute();
$result = $stmt->get_result();

if(mysqli_num_rows($result) == 0){
	$validateFlag = 400;
}
else{
	while($row = mysqli_fetch_assoc($result)){
		$systemNotifications_type = $row['systemNotifications_type'];
		$systemNotifications_title = $row['systemNotifications_title'];
		$systemNotifications_msg = $row['systemNotifications_msg'];
		$systemNotifications_users_id = $row['systemNotifications_users_id'];
		$systemNotifications_date = $row['systemNotifications_date'];
		$systemNotifications_ipAddress = $row['systemNotifications_ipAddress'];
		$systemUsers_name = $row['systemUsers_name'];
	}
}
$result->close();

if($validateFlag == 200){
?>
	<h1><?php echo purify($systemNotifications_title); ?></h1>
	<ul>
		<li class="active" onclick="modalTab('<?php echo purify($modalId); ?>', 1);">
			Generelt
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 2);">
			Bruger
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 3);">
			IP-adresse
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 4);">
			Mærker
		</li>
	</ul>
	<form onsubmit="return false;">
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input type="text" value="<?php echo purify($systemNotifications_type); ?>" readonly><label>Type</label><br>
			<input type="text" value="<?php echo purify($systemNotifications_date); ?>" readonly><label>Dato</label><br>
			<input type="text" value="<?php echo purify($systemNotifications_title); ?>" readonly><label>Titel</label><br>
			<input type="text" value="<?php echo purify($systemNotifications_msg); ?>" readonly><label>Besked</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input type="text" value="<?php echo purify($systemUsers_name); ?>" readonly><label>Bruger</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input type="text" value="<?php echo purify($systemNotifications_ipAddress); ?>" readonly><label>IP-adresse</label><br>
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
						`s0`.`tagsReferences`.`systemNotifications_id` = ?
					ORDER BY
						`c0`.`tags`.`name` ASC
				");
				$stmt->bind_param('i', $systemNotifications_id);
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
			<input class="edit" onclick="modal(<?php echo purify($modalId); ?>, 'large', '/systemNotifications/edit/modal.php', 'POST', '&systemNotifications_id=<?php echo encodeId(purify($systemNotifications_id)); ?>', false, 0)" type="button" value="Editer systemnotifikation"><input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk">
		</div>
	</form>
	<?php
	if(getSystemConfigurations('logSystemNotifications') == 1 || getSystemConfigurations('logSystemNotifications') == -1){
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
	if(getSystemConfigurations('logSystemNotifications') == 1 || getSystemConfigurations('logSystemNotifications') == -1){
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