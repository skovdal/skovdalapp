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
	<form action="/systemStorages/edit/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<input name="systemStorages_id" type="hidden" value="<?php echo encodeId(purify($systemStorages_id)); ?>">
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input id="inputName" name="name" pattern=".{3,}" placeholder="Jens Nielsen" type="text" value="<?php echo purify($systemStorages_name); ?>" required autofocus><label for="inputName">Navn</label><br>
			<select id="inputType" name="type" required>
				<optgroup label="Database">
					<option value="MariaDB" <?php if($systemStorages_type == 'MariaDB'){echo 'selected';} ?>>MariaDB</option>
					<option value="MySQL" <?php if($systemStorages_type == 'MySQL'){echo 'selected';} ?>>MySQL</option>
					<option value="Oracle" <?php if($systemStorages_type == 'Oracle'){echo 'selected';} ?>>Oracle</option>
					<option value="PostgreSQL" <?php if($systemStorages_type == 'PostgreSQL'){echo 'selected';} ?>>PostgreSQL</option>
					<option value="SQL" <?php if($systemStorages_type == 'SQL'){echo 'selected';} ?>>SQL</option>
				</optgroup>
				<option disabled></option>
				<optgroup label="Fillager">
					<option value="Amazon S3" <?php if($systemStorages_type == 'Amazon S3'){echo 'selected';} ?>>Amazon S3</option>
					<option value="Box" <?php if($systemStorages_type == 'Box'){echo 'selected';} ?>>Box</option>
					<option value="Dropbox" <?php if($systemStorages_type == 'Dropbox'){echo 'selected';} ?>>Dropbox</option>
					<option value="FTP" <?php if($systemStorages_type == 'FTP'){echo 'selected';} ?>>FTP</option>
					<option value="FTPS" <?php if($systemStorages_type == 'FTPS'){echo 'selected';} ?>>FTPS</option>
					<option value="Google Drive" <?php if($systemStorages_type == 'Google Drive'){echo 'selected';} ?>>Google Drives</option>
					<option value="Microsoft Azure" <?php if($systemStorages_type == 'Microsoft Azure'){echo 'selected';} ?>>Microsoft Azure</option>
					<option value="Microsoft OneDrive" <?php if($systemStorages_type == 'Microsoft OneDrive'){echo 'selected';} ?>>Microsoft OneDrive</option>
					<option value="Microsoft OneDrive for Business" <?php if($systemStorages_type == 'Microsoft OneDrive for Business'){echo 'selected';} ?>>Microsoft OneDrive for Business</option>
					<option value="SFTP" <?php if($systemStorages_type == 'SFTP'){echo 'selected';} ?>>SFTP</option>
					<option value="WebDav" <?php if($systemStorages_type == 'WebDav'){echo 'selected';} ?>>WebDav</option>
				</optgroup>
			</select><label for="inputType">Type</label><br>
		</div>
		
		<div>
			<input id="inputUsername" name="username" pattern=".{3,}" placeholder="pocahontas" type="text" value="<?php echo purify($systemStorages_username); ?>" required autofocus><label for="inputUsername">Brugernavn</label><br>
			<input id="inputPassword" name="password" pattern=".{3,}" placeholder="Adgangskode" type="password" value="<?php echo purify($systemStorages_password); ?>" required><label for="inputPassword">Adgangskode</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input id="inputHost" name="host" pattern=".{3,}" placeholder="123.123.123.123" type="text" value="<?php echo purify($systemStorages_host); ?>" required><label for="inputHost">Vært</label><br>
			<input id="inputPort" name="port" pattern=".{3,}" placeholder="123" type="text" value="<?php echo purify($systemStorages_port); ?>" required><label for="inputPort">Port</label><br>
			<input id="inputTimeout" name="timeout" pattern=".{3,}" placeholder="10s" type="text" value="<?php echo purify($systemStorages_timeout); ?>" required><label for="inputTimeout">Timeout</label><br>
			<input id="inputStorageSize" name="storageSize" pattern=".{3,}" placeholder="10s" type="text" value="<?php echo purify($systemStorages_storageSize); ?>" required><label for="inputStorageSize">Lagerstørrelse</label><br>
			<input id="inputFtpRemotePath" name="ftpRemotePath" pattern=".{3,}" placeholder="/" type="text" value="<?php echo purify($systemStorages_ftp_put_remote_path); ?>" required><label for="inputFtpRemotePath">FTP remote path</label><br>
			<div class="checkbox <?php if($systemStorages_ftpPassiveMode == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputFtpPassiveMode" name="ftpPassiveMode" type="checkbox" value="1" <?php if($systemStorages_ftpPassiveMode == 1){echo 'checked';} ?>><label for="inputFtpPassiveMode">Passiv</label></div><br>
			<input id="inputMySqlSocket" name="mySqlSocket" pattern=".{3,}" placeholder="/" type="text" value="<?php echo purify($systemStorages_mysql_socket); ?>" required><label for="inputMySqlSocket">MySQL socket</label><br>
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
				}
				else{
					while($row = mysqli_fetch_assoc($result)){
						echo '<div class="tag" onclick="modalDeleteTag(this, \'' . purify($row['tags_name']) . '\', \'' . purify($modalId) . '\');" style="background-color:' . purify($row['tags_backgroundColor']) . '; background-image:url(\'/images/svgImage.php?id=' . urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/times-circle.svg') . '&fill=' . urlencode(purify($row['tags_fontColor'])) . '\'); border:1px solid ' . purify($row['tags_borderColor']) . '; color:' . purify($row['tags_fontColor']) . ';">' . purify($row['tags_name']) . '</div>';
					}
				}
				$result->close();
							?>
			</div>
			<input class="addTag" onclick="modal(0, 'basic', '/systemStorages/edit/tags/add/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>&systemStorages_id=<?php echo encodeId(purify($systemStorages_id)); ?>', true, 1);" type="button" value="Tilføj mærke" autofocus>
			
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
			}
			else{
				while($row = mysqli_fetch_assoc($result)){
					echo '<input data-backgroundColor="' . purify($row['tags_backgroundColor']) . '" data-fontColor="' . purify($row['tags_fontColor']) . '" data-borderColor="' . purify($row['tags_borderColor']) . '" name="tag-name-' . encodeId(purify($row['tagsReferences_id'])) . '" type="hidden" value="' . purify($row['tags_name']) . '">';
					echo '<input data-backgroundColor="' . purify($row['tags_backgroundColor']) . '" data-fontColor="' . purify($row['tags_fontColor']) . '" data-borderColor="' . purify($row['tags_borderColor']) . '" name="tag-borderColor-' . encodeId(purify($row['tagsReferences_id'])) . '" type="hidden" value="' . purify($row['tags_borderColor']) . '">';
					echo '<input data-backgroundColor="' . purify($row['tags_backgroundColor']) . '" data-fontColor="' . purify($row['tags_fontColor']) . '" data-borderColor="' . purify($row['tags_borderColor']) . '" name="tag-backgroundColor-' . encodeId(purify($row['tagsReferences_id'])) . '" type="hidden" value="' . purify($row['tags_backgroundColor']) . '">';
					echo '<input data-backgroundColor="' . purify($row['tags_backgroundColor']) . '" data-fontColor="' . purify($row['tags_fontColor']) . '" data-borderColor="' . purify($row['tags_borderColor']) . '" name="tag-fontColor-' . encodeId(purify($row['tagsReferences_id'])) . '" type="hidden" value="' . purify($row['tags_fontColor']) . '">';
				}
			}
			$result->close();
			?>
		</div>
		
		<div class="buttons">
			<div class="pulseContainer"><div class="pulseCore danger"></div><div class="pulse danger"></div></div>
			<input class="delete" onclick="modal(0, 'basic', '/systemStorages/edit/delete/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>&systemStorages_id=<?php echo encodeId(purify($systemStorages_id)); ?>', true, 1);" type="button" value="Slet systemlager"><input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Gem systemlager">
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