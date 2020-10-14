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
		`c0`.`systemUsers`.`type` AS `systemUsers_type`,
		`c0`.`systemUsers`.`name` AS `systemUsers_name`,
		`c0`.`systemUsers`.`name2` AS `systemUsers_name2`,
		`c0`.`systemUsers`.`cvrNumber` AS `systemUsers_cvrNumber`,
		`c0`.`systemUsers`.`cprNumber` AS `systemUsers_cprNumber`,
		`c0`.`systemUsers`.`address` AS `systemUsers_address`,
		`c0`.`systemUsers`.`address2` AS `systemUsers_address2`,
		`c0`.`systemUsers`.`zipCode` AS `systemUsers_zipCode`,
		`c0`.`systemUsers`.`city` AS `systemUsers_city`,
		`c0`.`systemUsers`.`country` AS `systemUsers_country`,
		`c0`.`systemUsers`.`phone` AS `systemUsers_phone`,
		`c0`.`systemUsers`.`phone2` AS `systemUsers_phone2`,
		`c0`.`systemUsers`.`email` AS `systemUsers_email`,
		`c0`.`systemUsers`.`email2` AS `systemUsers_email2`
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
		$systemUsers_type = $row['systemUsers_type'];
		$systemUsers_name = $row['systemUsers_name'];
		$systemUsers_name2 = $row['systemUsers_name2'];
		$systemUsers_cvrNumber = $row['systemUsers_cvrNumber'];
		$systemUsers_cprNumber = $row['systemUsers_cprNumber'];
		$systemUsers_address = $row['systemUsers_address'];
		$systemUsers_address2 = $row['systemUsers_address2'];
		$systemUsers_zipCode = $row['systemUsers_zipCode'];
		$systemUsers_city = $row['systemUsers_city'];
		$systemUsers_country = $row['systemUsers_country'];
		$systemUsers_phone = $row['systemUsers_phone'];
		$systemUsers_phone2 = $row['systemUsers_phone2'];
		$systemUsers_email = $row['systemUsers_email'];
		$systemUsers_email2 = $row['systemUsers_email2'];
	}
}
$result->close();

if($validateFlag == 200){
?>
	<h1>Ny systembruger</h1>
	<ul>
		<li class="active" onclick="modalTab('<?php echo purify($modalId); ?>', 1);">
			Identitet
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
	<form action="/systemUsers/add/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<select id="inputType" name="type" autofocus required>
				<option value="Fysisk person" <?php if($systemUsers_type == 'Fysisk person'){echo 'selected';} ?>>Fysisk person</option>
				<option value="Juridisk person" <?php if($systemUsers_type == 'Juridisk person'){echo 'selected';} ?>>Juridisk person</option>
				<option value="Anden type" <?php if($systemUsers_type == 'Anden type'){echo 'selected';} ?>>Anden type</option>
			</select><label for="inputType">Type</label><br>
			<input id="inputName" name="name" pattern=".{3,}" placeholder="Jens Nielsen" type="text" value="<?php echo purify($systemUsers_name); ?>" required><label for="inputName">Navn</label><br>
			<input id="inputName2"  name="name2" pattern=".{3,}" placeholder="Økonomiafdelingen" type="text" value="<?php echo purify($systemUsers_name2); ?>"><label for="inputName2">Supplerende adresseoplysninger</label><br>
			<input id="inputCvrNumber"  name="cvrNumber" pattern="[0-9]{8}" placeholder="12345678" type="text" value="<?php echo purify($systemUsers_cvrNumber); ?>"><label for="inputCvrNumber">CVR-nummer</label><br>
			<input id="inputCprNumber" name="cprNumber" pattern="[0-9]{2}[0,1][0-9][0-9]{2}-[0-9]{4}" placeholder="010203-1234" type="text" value="<?php echo purify($systemUsers_cprNumber); ?>"><label for="inputCprNumber">CPR-nummer</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input id="inputDawaAddress" list="dawaAddressList" name="dawaAddress" oninput="dawa(this, '#inputAddress', '#inputAddress2', '#inputZipCode', '#inputCity', '#inputCountry');" pattern=".{3,}" placeholder="Rødkælkevej 3, Hadbjerg, 8370 Hadsten" type="text" autofocus><label for="inputDawaAddress">DAWA-adresse</label>
			<datalist id="dawaAddressList"></datalist>
			<br>
			<input id="inputAddress" name="address" pattern=".{3,}" placeholder="Rødkælkevej 3" type="text" value="<?php echo purify($systemUsers_address); ?>"><label for="inputAddress">Adresse</label><br>
			<input id="inputAddress2" name="address2" pattern=".{3,}" placeholder="Hadbjerg" type="text" value="<?php echo purify($systemUsers_address2); ?>"><label for="inputAddress2">Supplerende adresseoplysninger</label><br>
			<input id="inputZipCode" name="zipCode" pattern="[0-9]{4}" placeholder="8000" type="text" value="<?php echo purify($systemUsers_zipCode); ?>"><label for="inputZipCode">Postnummer</label><br>
			<input id="inputCity" name="city" pattern=".{3,}" placeholder="Aarhus" type="text" value="<?php echo purify($systemUsers_city); ?>"><label for="inputCity">By</label><br>
			
			<select id="inputCountry" name="country">
				<option value="DK">Danmark</option>
				<option value="SE">Sverige</option>
				<option value="">Ikke relevant</option>
			</select><label for="inputCountry">Land</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input id="inputPhone"  name="phone" pattern=".{3,}" placeholder="+45 12 34 56 78" type="text" value="<?php echo purify($systemUsers_phone); ?>" autofocus><label for="inputPhone">Telefon</label><br>
			<input id="inputPhone2"  name="phone2" pattern=".{3,}" placeholder="+45 23 45 67 89" type="text" value="<?php echo purify($systemUsers_phone2); ?>"><label for="inputPhone2">Sekundær telefon</label><br>
			<input id="inputEmail"  name="email" placeholder="navn@efternavn.dk" type="email" value="<?php echo purify($systemUsers_email); ?>"><label for="inputEmail">E-mail</label><br>
			<input id="inputEmail2"  name="email2" placeholder="efternavn@navn.dk" type="email" value="<?php echo purify($systemUsers_email2); ?>"><label for="inputEmail2">Sekundær e-mail</label><br>
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
				}
				else{
					while($row = mysqli_fetch_assoc($result)){
						echo '<div class="tag" onclick="modalDeleteTag(this, \'' . purify($row['tags_name']) . '\', \'' . purify($modalId) . '\');" style="background-color:' . purify($row['tags_backgroundColor']) . '; background-image:url(\'/images/svgImage.php?id=' . urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/times-circle.svg') . '&fill=' . urlencode(purify($row['tags_fontColor'])) . '\'); border:1px solid ' . purify($row['tags_borderColor']) . '; color:' . purify($row['tags_fontColor']) . ';">' . purify($row['tags_name']) . '</div>';
					}
				}
				$result->close();
							?>
			</div>
			<input class="addTag" onclick="modal(0, 'basic', '/systemUsers/edit/tags/add/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>&systemUsers_id=<?php echo encodeId(purify($systemUsers_id)); ?>', true, 1);" type="button" value="Tilføj mærke" autofocus>
			
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
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Gem systembruger">
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