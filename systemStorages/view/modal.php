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
		`c0`.`systemStorages`.`name` AS `systemStorages_name`,
		`c0`.`systemStorages`.`type` AS `systemStorages_type`,
		`c0`.`systemStorages`.`storageSize` AS `systemStorages_storageSize`,
		`c0`.`systemStorages`.`ftp_connect_host` AS `systemStorages_ftp_connect_host`,
		`c0`.`systemStorages`.`ftp_connect_port` AS `systemStorages_ftp_connect_port`,
		`c0`.`systemStorages`.`ftp_connect_timeout` AS `systemStorages_ftp_connect_timeout`,
		`c0`.`systemStorages`.`ftp_login_username` AS `systemStorages_ftp_login_username`,
		`c0`.`systemStorages`.`ftp_login_password` AS `systemStorages_ftp_login_password`,
		`c0`.`systemStorages`.`ftp_pasv_pasv` AS `systemStorages_ftp_ssl_connect_port`,
		`c0`.`systemStorages`.`ftp_ssl_connect_timeout` AS `systemStorages_ftp_ssl_connect_timeout`,
		`c0`.`systemStorages`.`ftp_put_remote_path` AS `systemStorages_ftp_put_remote_path`,
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
}
else{
	while($row = mysqli_fetch_assoc($result)){
		$systemStorages_name = $row['systemStorages_name'];
		$systemStorages_type = $row['systemStorages_type'];
		$systemStorages_storageSize = $row['systemStorages_storageSize'];
		$systemStorages_ftp_connect_host = $row['systemStorages_ftp_connect_host'];
		$systemStorages_ftp_connect_port = $row['systemStorages_ftp_connect_port'];
		$systemStorages_ftp_connect_timeout = $row['systemStorages_ftp_connect_timeout'];
		$systemStorages_ftp_login_username = $row['systemStorages_ftp_login_username'];
		$systemStorages_ftp_login_password = $row['systemStorages_ftp_login_password'];
		$systemStorages_ftp_ssl_connect_port = $row['systemStorages_ftp_ssl_connect_port'];
		$systemStorages_ftp_ssl_connect_timeout = $row['systemStorages_ftp_ssl_connect_timeout'];
		$systemStorages_ftp_put_remote_path = $row['systemStorages_ftp_put_remote_path'];
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
?>
	<input class="modalScript" type="hidden" value="(function(){checkConnection(0, document.querySelectorAll('#modal-' + modalId + ' form div.pulseContainer')[0], document.querySelectorAll('#modal-' + modalId + ' form #inputMySQLHost')[0], document.querySelectorAll('#modal-' + modalId + ' form #inputMySQLUsername')[0], document.querySelectorAll('#modal-' + modalId + ' form #inputMySQLPassword')[0], document.querySelectorAll('#modal-' + modalId + ' form #inputMySQLDbName')[0], document.querySelectorAll('#modal-' + modalId + ' form #inputMySQLPort')[0], document.querySelectorAll('#modal-' + modalId + ' form #inputMySQLSocket')[0]);})();">
	<h1><?php echo purify($systemStorages_name); ?></h1>
	<ul>
		<li class="active" onclick="modalTab('<?php echo purify($modalId); ?>', 1);">
			Generelt
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 2);">
			Autentificering
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 3);">
			Forbindelse
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 4);">
			Logbog
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 5);">
			Mærker
		</li>
	</ul>
	<form onsubmit="return false;">
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input type="text" value="<?php echo purify($systemStorages_name); ?>" readonly><label>Navn</label><br>
			<input type="text" value="<?php echo purify($systemStorages_type); ?>" readonly><label>Type</label><br>
			<input type="text" value="<?php echo purify($systemStorages_storageSize); ?>" readonly><label>Lagerstørrelse</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input id="inputMySQLUsername" type="text" value="<?php echo purify($systemStorages_mysql_username); ?>" readonly><label>MySQL-brugernavn</label><br>
			<input id="inputMySQLPassword" type="password" value="<?php echo purify($systemStorages_mysql_password); ?>" readonly><label>MySQL-adgangskode</label><br>
			<input type="text" value="<?php echo purify($systemStorages_ftp_login_username); ?>" readonly><label>FTP-brugernavn</label><br>
			<input type="password" value="" readonly><label>FTP-adgangskode</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input id="inputMySQLDbName" type="text" value="<?php echo purify($systemStorages_mysql_dbname); ?>" readonly><label>MySQL-database</label><br>
			<input id="inputMySQLHost" type="text" value="<?php echo purify($systemStorages_mysql_host); ?>" readonly><label>MySQL-værtsadresse</label><br>
			<input id="inputMySQLPort" type="text" value="<?php echo purify($systemStorages_mysql_port); ?>" readonly><label>MySQL-port</label><br>
			<input id="inputMySQLSocket" type="text" value="<?php echo purify($systemStorages_mysql_socket); ?>" readonly><label>MySQL-socket</label><br>
			<input type="text" value="<?php echo purify($systemStorages_ftp_connect_host); ?>" readonly><label>FTP-værtsadresse</label><br>
			<input type="text" value="<?php echo purify($systemStorages_ftp_connect_port); ?>" readonly><label>FTP-port</label><br>
			<input type="text" value="<?php echo purify($systemStorages_ftp_connect_timeout); ?>" readonly><label>FTP-timeout</label><br>
			<input type="text" value="<?php echo purify($systemStorages_ftp_put_remote_path); ?>" readonly><label>FTP remote path</label><br>
			<input type="text" value="<?php echo purify($systemStorages_ftp_ssl_connect_port); ?>" readonly><label>FTP-SSL-port</label><br>
			<input type="text" value="<?php echo purify($systemStorages_ftp_ssl_connect_timeout); ?>" readonly><label>FTP-SSL-timeout</label><br>
			<div class="checkbox <?php if($systemStorages_ftpPassiveMode == 1){echo 'checked';}else{echo 'unchecked';} ?>"><input type="checkbox" value="1" <?php if($systemStorages_ftpPassiveMode == 1){echo 'checked';} ?>><label>Passiv</label></div><br>
			<input type="text" value="<?php echo purify($systemStorages_timeout); ?>" readonly><label>FTP-timeout</label><br>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fbars.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					<br><br><br><br><br><br><br><br><br>Der er ikke registreret nogen hændelser
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
						`s0`.`tagsReferences`.`systemStorages_id` = ?
					ORDER BY
						`c0`.`tags`.`name` ASC
				");
				$stmt->bind_param('i', $systemStorages_id);
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
			<div class="pulseContainer"><div class="pulseCore danger"></div><div class="pulse danger"></div></div>
			<input class="delete" onclick="modal(0, 'basic', '/systemStorages/view/delete/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>&systemStorages_id=<?php echo encodeId(purify($systemStorages_id)); ?>', true, 1);" type="button" value="Slet systemlager"><input class="edit" onclick="modal(<?php echo purify($modalId); ?>, 'large', '/systemStorages/edit/modal.php', 'POST', '&systemStorages_id=<?php echo encodeId(purify($systemStorages_id)); ?>', false, 0)" type="button" value="Editer systemlager"><input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk">
		</div>
	</form>
	<?php
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