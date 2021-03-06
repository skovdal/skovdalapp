<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

$preferences_copyIdidentities_copyPrefix = getSystemPreferences('copyIdidentities_copyPrefix');
if($preferences_copyIdidentities_copyPrefix == -1){
	$validateFlag = 400;
}

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
		`c0`.`identities`.`email2` AS `identities_email2`
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
	}
}
$result->close();

if($validateFlag == 200){
?>
	<h1>Ny identitet</h1>
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
	<form action="/identities/add/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<select id="inputType" name="type" autofocus required>
				<option value="Fysisk person" <?php if($identities_type == 'Fysisk person'){echo 'selected';} ?>>Fysisk person</option>
				<option value="Juridisk person" <?php if($identities_type == 'Juridisk person'){echo 'selected';} ?>>Juridisk person</option>
				<option value="Anden type" <?php if($identities_type == 'Anden type'){echo 'selected';} ?>>Anden type</option>
			</select><label for="inputType">Type</label><br>
			<input id="inputName" name="name" pattern=".{3,}" placeholder="Jens Nielsen" type="text" value="<?php echo purify($preferences_copyIdidentities_copyPrefix . $identities_name); ?>" required><label for="inputName">Navn</label><br>
			<input id="inputName2"  name="name2" pattern=".{3,}" placeholder="Økonomiafdelingen" type="text" value="<?php echo purify($identities_name2); ?>"><label for="inputName2">Supplerende adresseoplysninger</label><br>
			<input id="inputCvrNumber"  name="cvrNumber" pattern="[0-9]{8}" placeholder="12345678" type="text" value="<?php echo purify($identities_cvrNumber); ?>"><label for="inputCvrNumber">CVR-nummer</label><br>
			<input id="inputCprNumber" name="cprNumber" pattern="[0-9]{2}[0,1][0-9][0-9]{2}-[0-9]{4}" placeholder="010203-1234" type="text" value="<?php echo purify($identities_cprNumber); ?>"><label for="inputCprNumber">CPR-nummer</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input id="inputDawaAddress" list="dawaAddressList" name="dawaAddress" oninput="dawa(this, '#inputAddress', '#inputAddress2', '#inputZipCode', '#inputCity', '#inputCountry');" pattern=".{3,}" placeholder="Rødkælkevej 3, Hadbjerg, 8370 Hadsten" type="text" autofocus><label for="inputDawaAddress">DAWA-adresse</label>
			<datalist id="dawaAddressList"></datalist>
			<br>
			<input id="inputAddress" name="address" pattern=".{3,}" placeholder="Rødkælkevej 3" type="text" value="<?php echo purify($identities_address); ?>"><label for="inputAddress">Adresse</label><br>
			<input id="inputAddress2" name="address2" pattern=".{3,}" placeholder="Hadbjerg" type="text" value="<?php echo purify($identities_address2); ?>"><label for="inputAddress2">Supplerende adresseoplysninger</label><br>
			<input id="inputZipCode" name="zipCode" pattern="[0-9]{4}" placeholder="8000" type="text" value="<?php echo purify($identities_zipCode); ?>"><label for="inputZipCode">Postnummer</label><br>
			<input id="inputCity" name="city" pattern=".{3,}" placeholder="Aarhus" type="text" value="<?php echo purify($identities_city); ?>"><label for="inputCity">By</label><br>
			
			<select id="inputCountry" name="country">
				<option value="DK">Danmark</option>
				<option value="SE">Sverige</option>
				<option value="">Ikke relevant</option>
			</select><label for="inputCountry">Land</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input id="inputPhone"  name="phone" pattern=".{3,}" placeholder="+45 12 34 56 78" type="text" value="<?php echo purify($identities_phone); ?>" autofocus><label for="inputPhone">Telefon</label><br>
			<input id="inputPhone2"  name="phone2" pattern=".{3,}" placeholder="+45 23 45 67 89" type="text" value="<?php echo purify($identities_phone2); ?>"><label for="inputPhone2">Sekundær telefon</label><br>
			<input id="inputEmail"  name="email" placeholder="navn@efternavn.dk" type="email" value="<?php echo purify($identities_email); ?>"><label for="inputEmail">E-mail</label><br>
			<input id="inputEmail2"  name="email2" placeholder="efternavn@navn.dk" type="email" value="<?php echo purify($identities_email2); ?>"><label for="inputEmail2">Sekundær e-mail</label><br>
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
				}
				else{
					while($row = mysqli_fetch_assoc($result)){
						echo '<div class="tag" onclick="modalDeleteTag(this, \'' . purify($row['tags_name']) . '\', \'' . purify($modalId) . '\');" style="background-color:' . purify($row['tags_backgroundColor']) . '; background-image:url(\'/images/svgImage.php?id=' . urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/times-circle.svg') . '&fill=' . urlencode(purify($row['tags_fontColor'])) . '\'); border:1px solid ' . purify($row['tags_borderColor']) . '; color:' . purify($row['tags_fontColor']) . ';">' . purify($row['tags_name']) . '</div>';
					}
				}
				$result->close();
							?>
			</div>
			<input class="addTag" onclick="modal(0, 'basic', '/identities/edit/tags/add/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>&identities_id=<?php echo encodeId(purify($identities_id)); ?>', true, 1);" type="button" value="Tilføj mærke" autofocus>
			
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
			}
			else{
				while($row = mysqli_fetch_assoc($result)){
					echo '<input data-backgroundColor="' . purify($row['tags_backgroundColor']) . '" data-fontColor="' . purify($row['tags_fontColor']) . '" data-borderColor="' . purify($row['tags_borderColor']) . '" name="tag-name-' . purify($row['tagsReferences_id']) . '" type="hidden" value="' . purify($row['tags_name']) . '">';
					echo '<input data-backgroundColor="' . purify($row['tags_backgroundColor']) . '" data-fontColor="' . purify($row['tags_fontColor']) . '" data-borderColor="' . purify($row['tags_borderColor']) . '" name="tag-borderColor-' . purify($row['tagsReferences_id']) . '" type="hidden" value="' . purify($row['tags_borderColor']) . '">';
					echo '<input data-backgroundColor="' . purify($row['tags_backgroundColor']) . '" data-fontColor="' . purify($row['tags_fontColor']) . '" data-borderColor="' . purify($row['tags_borderColor']) . '" name="tag-backgroundColor-' . purify($row['tagsReferences_id']) . '" type="hidden" value="' . purify($row['tags_backgroundColor']) . '">';
					echo '<input data-backgroundColor="' . purify($row['tags_backgroundColor']) . '" data-fontColor="' . purify($row['tags_fontColor']) . '" data-borderColor="' . purify($row['tags_borderColor']) . '" name="tag-fontColor-' . purify($row['tagsReferences_id']) . '" type="hidden" value="' . purify($row['tags_fontColor']) . '">';
				}
			}
			$result->close();
					?>
		</div>
		
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Gem identitet">
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