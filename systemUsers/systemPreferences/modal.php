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
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsName == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsName" name="columnsName" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsName == 1){echo 'checked';} ?>><label for="inputColumnsName">Navn</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsSecurityClearance == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsSecurityClearance" name="columnsSecurityClearance" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsSecurityClearance == 1){echo 'checked';} ?>><label for="inputColumnsSecurityClearance">Sikkerhedsgodkendelse</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsBlockSignIn == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsBlockSignIn" name="columnsBlockSignIn" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsBlockSignIn == 1){echo 'checked';} ?>><label for="inputColumnsBlockSignIn">Bloker log ind</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsUserMustChangePasswordAtNextSignIn" name="columnsUserMustChangePasswordAtNextSignIn" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn == 1){echo 'checked';} ?>><label for="inputColumnsUserMustChangePasswordAtNextSignIn">Brugeren skal ændre adgangskode ved næste log ind</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsForceUseOfMultifactorAuthentication == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsForceUseOfMultifactorAuthentication" name="columnsForceUseOfMultifactorAuthentication" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsForceUseOfMultifactorAuthentication == 1){echo 'checked';} ?>><label for="inputColumnsForceUseOfMultifactorAuthentication">Gennemtving brug af flerfaktorautentificering</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsEntityType == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsEntityType" name="columnsEntityType" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsEntityType == 1){echo 'checked';} ?>><label for="inputColumnsEntityType">Identitetstype</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsEntityName == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsEntityName" name="columnsEntityName" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsEntity == 1){echo 'checked';} ?>><label for="inputColumnsEntity">Identitetsnavn</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsEntityName2 == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsEntityName2" name="columnsEntityName2" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsEntityEntityName2 == 1){echo 'checked';} ?>><label for="inputColumnsEntityName2">Supplerende identitetsnavn</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsEntityPhone == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsEntityPhone" name="columnsEntityPhone" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsEntityEntityPhone == 1){echo 'checked';} ?>><label for="inputColumnsEntityPhone">Identitetstelefon</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsEntityEmail == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsEntityEmail" name="columnsEntityEmail" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsEntityEntityEmail == 1){echo 'checked';} ?>><label for="inputColumnsEntityEmail">Identitets-e-mail</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemUsers_columnsTags == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsTags" name="columnsTags" type="checkbox" value="1" <?php if($preferences_columnsSystemUsers_columnsTags == 1){echo 'checked';} ?>><label for="inputColumnsTags">Mærker</label></div><br>
			</div>
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
		$systemUsers_id = null;
		$systemUsersSystemPreferences_id = null;
		$tableVersions_id = null;
		$tags_id = null;
		$tagsReferences_id = null;
		
		addSystemEvent(
			$systemUsers_id,
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
			$systemUsers_id,
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