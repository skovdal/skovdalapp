<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

$preferences_shortcutsSystemUsers_shortcutsNew = getSystemPreferences('shortcutsSystemUsers_shortcutsNew');
if($preferences_shortcutsSystemUsers_shortcutsNew == -1){
	$preferences_shortcutsSystemUsers_shortcutsNew = 1;
}

$preferences_shortcutsSystemUsers_shortcutsUpdate = getSystemPreferences('shortcutsSystemUsers_shortcutsUpdate');
if($preferences_shortcutsSystemUsers_shortcutsUpdate == -1){
	$preferences_shortcutsSystemUsers_shortcutsUpdate = 1;
}

$preferences_shortcutsSystemUsers_shortcutsExport = getSystemPreferences('shortcutsSystemUsers_shortcutsExport');
if($preferences_shortcutsSystemUsers_shortcutsExport == -1){
	$preferences_shortcutsSystemUsers_shortcutsExport = 0;
}

$preferences_shortcutsSystemUsers_shortcutsTags = getSystemPreferences('shortcutsSystemUsers_shortcutsTags');
if($preferences_shortcutsSystemUsers_shortcutsTags == -1){
	$preferences_shortcutsSystemUsers_shortcutsTags = 1;
}

$preferences_shortcutsSystemUsers_shortcutsDelete = getSystemPreferences('shortcutsSystemUsers_shortcutsDelete');
if($preferences_shortcutsSystemUsers_shortcutsDelete == -1){
	$preferences_shortcutsSystemUsers_shortcutsDelete = 0;
}

$preferences_columnsSystemUsers_columnsName = getSystemPreferences('columnsSystemUsers_columnsName');
if($preferences_columnsSystemUsers_columnsName == -1){
	$preferences_columnsSystemUsers_columnsName = 1;
}

$preferences_columnsSystemUsers_columnsSecurityClearance = getSystemPreferences('columnsSystemUsers_columnsSecurityClearance');
if($preferences_columnsSystemUsers_columnsSecurityClearance == -1){
	$preferences_columnsSystemUsers_columnsSecurityClearance = 0;
}

$preferences_columnsSystemUsers_columnsBlockSignIn = getSystemPreferences('columnsSystemUsers_columnsBlockSignIn');
if($preferences_columnsSystemUsers_columnsBlockSignIn == -1){
	$preferences_columnsSystemUsers_columnsBlockSignIn = 1;
}

$preferences_columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn = getSystemPreferences('columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn');
if($preferences_columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn == -1){
	$preferences_columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn = 0;
}

$preferences_columnsSystemUsers_columnsForceUseOfMultifactorAuthentication = getSystemPreferences('columnsSystemUsers_columnsForceUseOfMultifactorAuthentication');
if($preferences_columnsSystemUsers_columnsForceUseOfMultifactorAuthentication == -1){
	$preferences_columnsSystemUsers_columnsForceUseOfMultifactorAuthentication = 0;
}

$preferences_columnsSystemUsers_columnsEntityType = getSystemPreferences('columnsSystemUsers_columnsEntityType');
if($preferences_columnsSystemUsers_columnsEntityType == -1){
	$preferences_columnsSystemUsers_columnsEntityType = 0;
}

$preferences_columnsSystemUsers_columnsEntityName = getSystemPreferences('columnsSystemUsers_columnsEntityName');
if($preferences_columnsSystemUsers_columnsEntityName == -1){
	$preferences_columnsSystemUsers_columnsEntityName = 1;
}

$preferences_columnsSystemUsers_columnsEntityName2 = getSystemPreferences('columnsSystemUsers_columnsEntityName2');
if($preferences_columnsSystemUsers_columnsEntityName2 == -1){
	$preferences_columnsSystemUsers_columnsEntityName2 = 0;
}

$preferences_columnsSystemUsers_columnsEntityPhone = getSystemPreferences('columnsSystemUsers_columnsEntityPhone');
if($preferences_columnsSystemUsers_columnsEntityPhone == -1){
	$preferences_columnsSystemUsers_columnsEntityPhone = 0;
}

$preferences_columnsSystemUsers_columnsEntityEmail = getSystemPreferences('columnsSystemUsers_columnsEntityEmail');
if($preferences_columnsSystemUsers_columnsEntityEmail == -1){
	$preferences_columnsSystemUsers_columnsEntityEmail = 0;
}

$preferences_columnsSystemUsers_columnsTags = getSystemPreferences('columnsSystemUsers_columnsTags');
if($preferences_columnsSystemUsers_columnsTags == -1){
	$preferences_columnsSystemUsers_columnsTags = 1;
}

$preferences_orderBySystemUsers_orderBy = getSystemPreferences('orderBySystemUsers_orderBy');
if($preferences_orderBySystemUsers_orderBy == -1){
	$preferences_orderBySystemUsers_orderBy = 'Name';
}

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if($validateFlag == 200){
?>
	<h1>Præferencer for systembrugere</h1>
	<ul>
		<li class="active" onclick="modalTab('<?php echo purify($modalId); ?>', 1);">
			Genveje
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 2);">
			Kolonner
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 3);">
			Sikkerhedskopiering
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 3);">
			Sortering
		</li>
	</ul>
	<form action="/systemUsers/systemPreferences/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div style="column-count:1;">
				<div class="checkbox <?php if($preferences_shortcutsSystemUsers_shortcutsNew == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsNew" name="shortcutsNew" type="checkbox" value="1" <?php if($preferences_shortcutsSystemUsers_shortcutsNew == 1){echo 'checked';} ?>><label for="inputShortcutsNew">Ny systembruger</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsSystemUsers_shortcutsUpdate == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsUpdate" name="shortcutsUpdate" type="checkbox" value="1" <?php if($preferences_shortcutsSystemUsers_shortcutsUpdate == 1){echo 'checked';} ?>><label for="inputShortcutsUpdate">Opdater systembrugere</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsSystemUsers_shortcutsExport == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsExport" name="shortcutsExport" type="checkbox" value="1" <?php if($preferences_shortcutsSystemUsers_shortcutsExport == 1){echo 'checked';} ?>><label for="inputShortcutsExport">Eksporter markerede systembrugere</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsSystemUsers_shortcutsTags == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsTags" name="shortcutsTags" type="checkbox" value="1" <?php if($preferences_shortcutsSystemUsers_shortcutsTags == 1){echo 'checked';} ?>><label for="inputShortcutsTags">Tilføj mærke på markerede systembrugere</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsSystemUsers_shortcutsDelete == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsDelete" name="shortcutsDelete" type="checkbox" value="1" <?php if($preferences_shortcutsSystemUsers_shortcutsDelete == 1){echo 'checked';} ?>><label for="inputShortcutsDelete">Slet markerede systembrugere</label></div><br>
			</div>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div style="column-count:3;">
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsName == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsName" name="columnsName" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsName == 1){echo 'checked';} ?>><label for="inputcolumnsName">Navn</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsSecurityClearance == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsSecurityClearance" name="columnsSecurityClearance" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsSecurityClearance == 1){echo 'checked';} ?>><label for="inputcolumnsSecurityClearance">Sikkerhedsgodkendelse</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsBlockSignIn == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsBlockSignIn" name="columnsBlockSignIn" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsBlockSignIn == 1){echo 'checked';} ?>><label for="inputcolumnsBlockSignIn">Bloker log ind</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsUserMustChangePasswordAtNextSignIn" name="columnsUserMustChangePasswordAtNextSignIn" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn == 1){echo 'checked';} ?>><label for="inputcolumnsUserMustChangePasswordAtNextSignIn">Brugeren skal ændre adgangskode ved næste log ind</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsForceUseOfMultifactorAuthentication == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsForceUseOfMultifactorAuthentication" name="columnsForceUseOfMultifactorAuthentication" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsForceUseOfMultifactorAuthentication == 1){echo 'checked';} ?>><label for="inputcolumnsForceUseOfMultifactorAuthentication">Gennemtving brug af flerfaktorautentificering</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsEntityType == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsEntityType" name="columnsEntityType" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsEntityType == 1){echo 'checked';} ?>><label for="inputcolumnsEntityType">Identitetstype</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsEntityName == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsEntityName" name="columnsEntityName" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsEntity == 1){echo 'checked';} ?>><label for="inputcolumnsEntity">Identitetsnavn</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsEntityName2 == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsEntityName2" name="columnsEntityName2" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsEntityEntityName2 == 1){echo 'checked';} ?>><label for="inputcolumnsEntityName2">Supplerende identitetsnavn</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsEntityPhone == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsEntityPhone" name="columnsEntityPhone" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsEntityEntityPhone == 1){echo 'checked';} ?>><label for="inputcolumnsEntityPhone">Identitetstelefon</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsEntityEmail == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsEntityEmail" name="columnsEntityEmail" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsEntityEntityEmail == 1){echo 'checked';} ?>><label for="inputcolumnsEntityEmail">Identitets-e-mail</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsTags == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsTags" name="columnsTags" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsTags == 1){echo 'checked';} ?>><label for="inputcolumnsTags">Mærker</label></div><br>
			</div>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<select id="inputSystemStorages_id" name="systemStorages_id">
				<?php
				if(isset($con) === false){$con = dbConnection();}
				$stmt = $con->stmt_init();
				$stmt->prepare("
					SELECT
						`c0`.`systemStorages`.`id` AS `systemStorages_id`,
						`c0`.`systemStorages`.`name` AS `systemStorages_name`
					FROM
						`c0`.`systemStorages`
					WHERE
						`c0`.`systemStorages`.`deleteFlag` IS NULL
					AND
						`c0`.`systemStorages`.`tempFlag` IS NULL
					AND
						`c0`.`systemStorages`.`legacyFlag` IS NULL
					ORDER BY
						`c0`.`systemStorages`.`name` ASC
				");
				$stmt->execute();
				$result = $stmt->get_result();
				
				if(mysqli_num_rows($result) == 0){
				}
				else{
					while($row = mysqli_fetch_assoc($result)){
					?>
						<option value="<?php echo $row['systemStorages_id']; ?>"><?php echo $row['systemStorages_name']; ?></option>
					<?php
					}
				}
				$result->close();
				?>
			</select><label for="inputSystemStorages_id">Lager</label><br>
			<select id="inputSystemStorages_id" name="systemStorages_id">
				<option value="5m">5 minutter</option>
				<option value="10m">10 minutter</option>
				<option value="15m">15 minutter</option>
				<option value="30m">30 minutter</option>
				<option value="1h">1 time</option>
				<option value="2h">2 timer</option>
				<option value="3h">3 timer</option>
				<option value="6h">6 timer</option>
				<option value="8h">8 timer</option>
				<option value="12h">12 timer</option>
				<option value="1d">1 dag</option>
				<option value="2d">2 dage</option>
				<option value="3d">3 dage</option>
				<option value="4d">4 dage</option>
				<option value="5d">5 dage</option>
				<option value="6d">6 dage</option>
				<option value="1w">1 uge</option>
				<option value="2w">2 uger</option>
				<option value="3w">3 uger</option>
				<option value="1m">1 måned</option>
				<option value="2m">2 måneder</option>
				<option value="3m">3 måneder</option>
				<option value="4m">4 måneder</option>
				<option value="5m">5 måneder</option>
				<option value="6m">6 måneder</option>
				<option value="1y">1 år</option>
			</select><label for="inputSystemStorages_id">Frekvens</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<select id="inputOrderBy" name="orderBy" autofocus required>
				<option value="Name" <?php if($preferences_orderBySystemUsers_orderBy == 'Name'){echo 'selected';} ?>>Navn</option>
				<option value="SecurityClearance" <?php if($preferences_orderBySystemUsers_orderBy == 'SecurityClearance'){echo 'selected';} ?>>Sikkerhedsgodkendelse</option>
				<option value="BlockSignIn" <?php if($preferences_orderBySystemUsers_orderBy == 'BlockSignIn'){echo 'selected';} ?>>Bloker log ind</option>
				<option value="UserMustChangePasswordAtNextSignIn" <?php if($preferences_orderBySystemUsers_orderBy == 'UserMustChangePasswordAtNextSignIn'){echo 'selected';} ?>>Brugeren skal ændre adgangskode ved næste log ind</option>
				<option value="ForceUseOfMultifactorAuthentication" <?php if($preferences_orderBySystemUsers_orderBy == 'ForceUseOfMultifactorAuthentication'){echo 'selected';} ?>>Gennemtving brug af flerfaktorautentificering</option>
				<option value="Identities_type" <?php if($preferences_orderBySystemUsers_orderBy == 'Identities_type'){echo 'selected';} ?>>Identitetstype</option>
				<option value="Identities_name" <?php if($preferences_orderBySystemUsers_orderBy == 'Identities_name'){echo 'selected';} ?>>Identitetsnavn</option>
				<option value="Identities_name2" <?php if($preferences_orderBySystemUsers_orderBy == 'Identities_name2'){echo 'selected';} ?>>Supplerende identitetsnavn</option>
				<option value="Identities_phone" <?php if($preferences_orderBySystemUsers_orderBy == 'Identities_phone'){echo 'selected';} ?>>Identitetstelefon</option>
				<option value="Identities_email" <?php if($preferences_orderBySystemUsers_orderBy == 'Identities_email'){echo 'selected';} ?>>Identitets-e-mail</option>
			</select><label for="inputOrderBy">Standardsortering</label><br>
		</div>
		
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Gem præferencer">
		</div>
	</form>
	<?php
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