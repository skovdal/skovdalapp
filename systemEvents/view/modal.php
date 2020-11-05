<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if(isset($_POST['systemEvents_id']) === false){
	$validateFlag = 400;
}
else{
	$systemEvents_id = $_POST['systemEvents_id'];
	if(decodeId($systemEvents_id) == -1){
		$validateFlag = 400;
	}
	else{
		$systemEvents_id = decodeId($systemEvents_id);
	}
}

if(isset($con) === false){$con = dbConnection();}
$stmt = $con->stmt_init();
$stmt->prepare("
	SELECT
		`c0`.`systemEvents`.`type` AS `systemEvents_type`,
		`c0`.`systemEvents`.`title` AS `systemEvents_title`,
		`c0`.`systemEvents`.`msg` AS `systemEvents_msg`,
		`c0`.`systemEvents`.`users_id` AS `systemEvents_users_id`,
		DATE_FORMAT(`c0`.`systemEvents`.`date`, '%d-%m-%Y %H:%i:%s') AS `systemEvents_date`,
		`c0`.`systemEvents`.`ipAddress` AS `systemEvents_ipAddress`,
		(
			SELECT
				`c0`.`systemUsers`.`name`
			FROM
				`c0`.`systemUsers`
			WHERE
				`c0`.`systemUsers`.`id` = `systemEvents_users_id`
		) AS `systemUsers_name`
	FROM
		`c0`.`systemEvents`
	WHERE
		`c0`.`systemEvents`.`id` = ?
	LIMIT 1
");
$stmt->bind_param('i', $systemEvents_id);
$stmt->execute();
$result = $stmt->get_result();

if(mysqli_num_rows($result) == 0){
	$validateFlag = 400;
}
else{
	while($row = mysqli_fetch_assoc($result)){
		$systemEvents_type = $row['systemEvents_type'];
		$systemEvents_title = $row['systemEvents_title'];
		$systemEvents_msg = $row['systemEvents_msg'];
		$systemEvents_users_id = $row['systemEvents_users_id'];
		$systemEvents_date = $row['systemEvents_date'];
		$systemEvents_ipAddress = $row['systemEvents_ipAddress'];
		$systemUsers_name = $row['systemUsers_name'];
	}
}
$result->close();

if($validateFlag == 200){
?>
	<h1><?php echo purify($systemEvents_title); ?></h1>
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
			<input type="text" value="<?php echo purify($systemEvents_type); ?>" readonly><label>Type</label><br>
			<input type="text" value="<?php echo purify($systemEvents_date); ?>" readonly><label>Dato</label><br>
			<input type="text" value="<?php echo purify($systemEvents_title); ?>" readonly><label>Titel</label><br>
			<input type="text" value="<?php echo purify($systemEvents_msg); ?>" readonly><label>Besked</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input type="text" value="<?php echo purify($systemUsers_name); ?>" readonly><label>Bruger</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input type="text" value="<?php echo purify($systemEvents_ipAddress); ?>" readonly><label>IP-adresse</label><br>
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
						`s0`.`tagsReferences`.`systemEvents_id` = ?
					ORDER BY
						`c0`.`tags`.`name` ASC
				");
				$stmt->bind_param('i', $systemEvents_id);
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
			<input class="edit" onclick="modal(<?php echo purify($modalId); ?>, 'large', '/systemEvents/edit/modal.php', 'POST', '&systemEvents_id=<?php echo encodeId(purify($systemEvents_id)); ?>', false, 0)" type="button" value="Editer systemhændelse"><input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk">
		</div>
	</form>
	<?php
	if(getSystemConfigurations('logSystemEvents') == 1 || getSystemConfigurations('logSystemEvents') == -1){
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
	if(getSystemConfigurations('logSystemEvents') == 1 || getSystemConfigurations('logSystemEvents') == -1){
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
	
	httpStatusCodes($validateFlag);
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>