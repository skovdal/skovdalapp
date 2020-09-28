<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

$preferences_shortcutsIdidentities_shortcutsNew = getSystemPreferences('shortcutsIdidentities_shortcutsNew');
if($preferences_shortcutsIdidentities_shortcutsNew == -1){
	$preferences_shortcutsIdidentities_shortcutsNew = 1;
}

$preferences_shortcutsIdidentities_shortcutsUpdate = getSystemPreferences('shortcutsIdidentities_shortcutsUpdate');
if($preferences_shortcutsIdidentities_shortcutsUpdate == -1){
	$preferences_shortcutsIdidentities_shortcutsUpdate = 1;
}

$preferences_shortcutsIdidentities_shortcutsExport = getSystemPreferences('shortcutsIdidentities_shortcutsExport');
if($preferences_shortcutsIdidentities_shortcutsExport == -1){
	$preferences_shortcutsIdidentities_shortcutsExport = 0;
}

$preferences_shortcutsIdidentities_shortcutsTags = getSystemPreferences('shortcutsIdidentities_shortcutsTags');
if($preferences_shortcutsIdidentities_shortcutsTags == -1){
	$preferences_shortcutsIdidentities_shortcutsTags = 1;
}

$preferences_shortcutsIdidentities_shortcutsDelete = getSystemPreferences('shortcutsIdidentities_shortcutsDelete');
if($preferences_shortcutsIdidentities_shortcutsDelete == -1){
	$preferences_shortcutsIdidentities_shortcutsDelete = 0;
}

$preferences_columnsIdidentities_columnsType = getSystemPreferences('columnsIdidentities_columnsType');
if($preferences_columnsIdidentities_columnsType == -1){
	$preferences_columnsIdidentities_columnsType = 1;
}

$preferences_columnsIdidentities_columnsName = getSystemPreferences('columnsIdidentities_columnsName');
if($preferences_columnsIdidentities_columnsName == -1){
	$preferences_columnsIdidentities_columnsName = 1;
}

$preferences_columnsIdidentities_columnsName2 = getSystemPreferences('columnsIdidentities_columnsName2');
if($preferences_columnsIdidentities_columnsName2 == -1){
	$preferences_columnsIdidentities_columnsName2 = 0;
}

$preferences_columnsIdidentities_columnsCvrNumber = getSystemPreferences('columnsIdidentities_columnsCvrNumber');
if($preferences_columnsIdidentities_columnsCvrNumber == -1){
	$preferences_columnsIdidentities_columnsCvrNumber = 0;
}

$preferences_columnsIdidentities_columnsCprNumber = getSystemPreferences('columnsIdidentities_columnsCprNumber');
if($preferences_columnsIdidentities_columnsCprNumber == -1){
	$preferences_columnsIdidentities_columnsCprNumber = 0;
}

$preferences_columnsIdidentities_columnsAddress = getSystemPreferences('columnsIdidentities_columnsAddress');
if($preferences_columnsIdidentities_columnsAddress == -1){
	$preferences_columnsIdidentities_columnsAddress = 0;
}

$preferences_columnsIdidentities_columnsAddress2 = getSystemPreferences('columnsIdidentities_columnsAddress2');
if($preferences_columnsIdidentities_columnsAddress2 == -1){
	$preferences_columnsIdidentities_columnsAddress2 = 0;
}

$preferences_columnsIdidentities_columnsZipCode = getSystemPreferences('columnsIdidentities_columnsZipCode');
if($preferences_columnsIdidentities_columnsZipCode == -1){
	$preferences_columnsIdidentities_columnsZipCode = 0;
}

$preferences_columnsIdidentities_columnsCity = getSystemPreferences('columnsIdidentities_columnsCity');
if($preferences_columnsIdidentities_columnsCity == -1){
	$preferences_columnsIdidentities_columnsCity = 0;
}

$preferences_columnsIdidentities_columnsCountry = getSystemPreferences('columnsIdidentities_columnsCountry');
if($preferences_columnsIdidentities_columnsCountry == -1){
	$preferences_columnsIdidentities_columnsCountry = 0;
}

$preferences_columnsIdidentities_columnsPhone = getSystemPreferences('columnsIdidentities_columnsPhone');
if($preferences_columnsIdidentities_columnsPhone == -1){
	$preferences_columnsIdidentities_columnsPhone = 0;
}

$preferences_columnsIdidentities_columnsPhone2 = getSystemPreferences('columnsIdidentities_columnsPhone2');
if($preferences_columnsIdidentities_columnsPhone2 == -1){
	$preferences_columnsIdidentities_columnsPhone2 = 0;
}

$preferences_columnsIdidentities_columnsEmail = getSystemPreferences('columnsIdidentities_columnsEmail');
if($preferences_columnsIdidentities_columnsEmail == -1){
	$preferences_columnsIdidentities_columnsEmail = 1;
}

$preferences_columnsIdidentities_columnsEmail2 = getSystemPreferences('columnsIdidentities_columnsEmail2');
if($preferences_columnsIdidentities_columnsEmail2 == -1){
	$preferences_columnsIdidentities_columnsEmail2 = 0;
}

$preferences_columnsIdidentities_columnsTags = getSystemPreferences('columnsIdidentities_columnsTags');
if($preferences_columnsIdidentities_columnsTags == -1){
	$preferences_columnsIdidentities_columnsTags = 1;
}

$preferences_copyIdidentities_copyPrefix = getSystemPreferences('copyIdidentities_copyPrefix');
if($preferences_copyIdidentities_copyPrefix == -1){
	$preferences_copyIdidentities_copyPrefix = 'Kopi af ';
}

$preferences_newEntityIdidentities_newEntityType = getSystemPreferences('newEntityIdidentities_newEntityType');
if($preferences_newEntityIdidentities_newEntityType == -1){
	$preferences_newEntityIdidentities_newEntityType = -1;
}

$preferences_newEntityIdidentities_newEntityPreEnteredCvrNumber = getSystemPreferences('newEntityIdidentities_newEntityPreEnteredCvrNumber');
if($preferences_newEntityIdidentities_newEntityPreEnteredCvrNumber == -1){
	$preferences_newEntityIdidentities_newEntityPreEnteredCvrNumber = '';
}

$preferences_orderByIdidentities_orderBy = getSystemPreferences('orderByIdidentities_orderBy');
if($preferences_orderByIdidentities_orderBy == -1){
	$preferences_orderByIdidentities_orderBy = 'Name';
}

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if($validateFlag == 200){
?>
	<h1>Præferencer for identiteter</h1>
	<ul>
		<li class="active" onclick="modalTab('<?php echo purify($modalId); ?>', 1);">
			Genveje
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 2);">
			Kolonner
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 3);">
			Kopiering
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 4);">
			Ny identitet
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 5);">
			Sortering
		</li>
	</ul>
	<form action="/identities/systemPreferences/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div style="column-count:1;">
				<div class="checkbox <?php if($preferences_shortcutsIdidentities_shortcutsNew == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsNew" name="shortcutsNew" type="checkbox" value="1" <?php if($preferences_shortcutsIdidentities_shortcutsNew == 1){echo 'checked';} ?>><label for="inputShortcutsNew">Ny identitet</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsIdidentities_shortcutsUpdate == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsUpdate" name="shortcutsUpdate" type="checkbox" value="1" <?php if($preferences_shortcutsIdidentities_shortcutsUpdate == 1){echo 'checked';} ?>><label for="inputShortcutsUpdate">Opdater identiteter</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsIdidentities_shortcutsExport == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsExport" name="shortcutsExport" type="checkbox" value="1" <?php if($preferences_shortcutsIdidentities_shortcutsExport == 1){echo 'checked';} ?>><label for="inputShortcutsExport">Eksporter markerede identiteter</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsIdidentities_shortcutsTags == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsTags" name="shortcutsTags" type="checkbox" value="1" <?php if($preferences_shortcutsIdidentities_shortcutsTags == 1){echo 'checked';} ?>><label for="inputShortcutsTags">Tilføj mærke på markerede identiteter</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsIdidentities_shortcutsDelete == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsDelete" name="shortcutsDelete" type="checkbox" value="1" <?php if($preferences_shortcutsIdidentities_shortcutsDelete == 1){echo 'checked';} ?>><label for="inputShortcutsDelete">Slet markerede identiteter</label></div><br>
			</div>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div style="column-count:3;">
				<div class="checkbox <?php if($preferences_columnsIdidentities_columnsType == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsType" name="columnsType" type="checkbox" value="1" <?php if($preferences_columnsIdidentities_columnsType == 1){echo 'checked';} ?>><label for="inputcolumnsType">Type</label></div><br>
				<div class="checkbox <?php if($preferences_columnsIdidentities_columnsName == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsName" name="columnsName" type="checkbox" value="1" <?php if($preferences_columnsIdidentities_columnsName == 1){echo 'checked';} ?>><label for="inputcolumnsName">Navn</label></div><br>
				<div class="checkbox <?php if($preferences_columnsIdidentities_columnsName2 == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsName2" name="columnsName2" type="checkbox" value="1" <?php if($preferences_columnsIdidentities_columnsName2 == 1){echo 'checked';} ?>><label for="inputcolumnsName2">Supplerende navneoplysninger</label></div><br>
				<div class="checkbox <?php if($preferences_columnsIdidentities_columnsCvrNumber == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsCvrNumber" name="columnsCvrNumber" type="checkbox" value="1" <?php if($preferences_columnsIdidentities_columnsCvrNumber == 1){echo 'checked';} ?>><label for="inputcolumnsCvrNumber">CVR-nummer</label></div><br>
				<div class="checkbox <?php if($preferences_columnsIdidentities_columnsCprNumber == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsCprNumber" name="columnsCprNumber" type="checkbox" value="1" <?php if($preferences_columnsIdidentities_columnsCprNumber == 1){echo 'checked';} ?>><label for="inputcolumnsCprNumber">CPR-nummer</label></div><br>
				<div class="checkbox <?php if($preferences_columnsIdidentities_columnsAddress == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsAddress" name="columnsAddress" type="checkbox" value="1" <?php if($preferences_columnsIdidentities_columnsAddress == 1){echo 'checked';} ?>><label for="inputcolumnsAddress">Adresse</label></div><br>
				<div class="checkbox <?php if($preferences_columnsIdidentities_columnsAddress2 == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsAddress2" name="columnsAddress2" type="checkbox" value="1" <?php if($preferences_columnsIdidentities_columnsAddress2 == 1){echo 'checked';} ?>><label for="inputcolumnsAddress2">Supplerende adresseoplysninger</label></div><br>
				<div class="checkbox <?php if($preferences_columnsIdidentities_columnsZipCode == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsZipCode" name="columnsZipCode" type="checkbox" value="1" <?php if($preferences_columnsIdidentities_columnsZipCode == 1){echo 'checked';} ?>><label for="inputcolumnsZipCode">Postnummer</label></div><br>
				<div class="checkbox <?php if($preferences_columnsIdidentities_columnsCity == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsCity" name="columnsCity" type="checkbox" value="1" <?php if($preferences_columnsIdidentities_columnsCity == 1){echo 'checked';} ?>><label for="inputcolumnsCity">By</label></div><br>
				<div class="checkbox <?php if($preferences_columnsIdidentities_columnsCountry == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsCountry" name="columnsCountry" type="checkbox" value="1" <?php if($preferences_columnsIdidentities_columnsCountry == 1){echo 'checked';} ?>><label for="inputcolumnsCountry">Land</label></div><br>
				<div class="checkbox <?php if($preferences_columnsIdidentities_columnsPhone == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsPhone" name="columnsPhone" type="checkbox" value="1" <?php if($preferences_columnsIdidentities_columnsPhone == 1){echo 'checked';} ?>><label for="inputcolumnsPhone">Telefon</label></div><br>
				<div class="checkbox <?php if($preferences_columnsIdidentities_columnsPhone2 == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsPhone2" name="columnsPhone2" type="checkbox" value="1" <?php if($preferences_columnsIdidentities_columnsPhone2 == 1){echo 'checked';} ?>><label for="inputcolumnsPhone2">Sekundær telefon</label></div><br>
				<div class="checkbox <?php if($preferences_columnsIdidentities_columnsEmail == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsEmail" name="columnsEmail" type="checkbox" value="1" <?php if($preferences_columnsIdidentities_columnsEmail == 1){echo 'checked';} ?>><label for="inputcolumnsEmail">E-mail</label></div><br>
				<div class="checkbox <?php if($preferences_columnsIdidentities_columnsEmail2 == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsEmail2" name="columnsEmail2" type="checkbox" value="1" <?php if($preferences_columnsIdidentities_columnsEmail2 == 1){echo 'checked';} ?>><label for="inputcolumnsEmail2">Sekundær e-mail</label></div><br>
				<div class="checkbox <?php if($preferences_columnsIdidentities_columnsTags == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsTags" name="columnsTags" type="checkbox" value="1" <?php if($preferences_columnsIdidentities_columnsTags == 1){echo 'checked';} ?>><label for="inputcolumnsTags">Mærker</label></div><br>
			</div>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input id="inputCopyPrefix" name="copyPrefix" placeholder="Kopi af " type="text" value="<?php echo purify($preferences_copyIdidentities_copyPrefix); ?>" autofocus><label for="inputCopyPrefix">Præfiks til navn</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<select id="inputNewEntityType" name="newEntityType" autofocus required>
				<option value="Fysisk person" <?php if($preferences_newEntityIdidentities_newEntityType == 'Fysisk person'){echo 'selected';} ?>>Fysisk person</option>
				<option value="Juridisk person" <?php if($preferences_newEntityIdidentities_newEntityType == 'Juridisk person'){echo 'selected';} ?>>Juridisk person</option>
				<option value="Anden type" <?php if($preferences_newEntityIdidentities_newEntityType == 'Anden type'){echo 'selected';} ?>>Anden type</option>
			</select><label for="inputNewEntityType">Forvalgt type</label><br>
			<input id="inputNewEntityPreEnteredCvrNumber" name="newEntityPreEnteredCvrNumber" pattern="[0-9]{8}" placeholder="12345678" type="text" value="<?php echo purify($preferences_newEntityIdidentities_newEntityPreEnteredCvrNumber); ?>"><label for="inputNewEntityPreEnteredCvrNumber">Præindtastet CVR-nummer</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<select id="inputOrderBy" name="orderBy" autofocus required>
				<option value="Type" <?php if($preferences_orderByIdidentities_orderBy == 'Type'){echo 'selected';} ?>>Type</option>
				<option value="Name" <?php if($preferences_orderByIdidentities_orderBy == 'Name'){echo 'selected';} ?>>Navn</option>
				<option value="Name2" <?php if($preferences_orderByIdidentities_orderBy == 'Name2'){echo 'selected';} ?>>Supplerende navneoplysninger</option>
				<option value="CvrNumber" <?php if($preferences_orderByIdidentities_orderBy == 'CvrNumber'){echo 'selected';} ?>>CVR-nummer</option>
				<option value="CprNumber" <?php if($preferences_orderByIdidentities_orderBy == 'CprNumber'){echo 'selected';} ?>>CPR-nummer</option>
				<option value="Address" <?php if($preferences_orderByIdidentities_orderBy == 'Address'){echo 'selected';} ?>>Adresse</option>
				<option value="Address2" <?php if($preferences_orderByIdidentities_orderBy == 'Address2'){echo 'selected';} ?>>Supplerende adresseoplysninger</option>
				<option value="ZipCode" <?php if($preferences_orderByIdidentities_orderBy == 'ZipCode'){echo 'selected';} ?>>Postnummer</option>
				<option value="City" <?php if($preferences_orderByIdidentities_orderBy == 'City'){echo 'selected';} ?>>By</option>
				<option value="Country" <?php if($preferences_orderByIdidentities_orderBy == 'Country'){echo 'selected';} ?>>Land</option>
				<option value="Phone" <?php if($preferences_orderByIdidentities_orderBy == 'Phone'){echo 'selected';} ?>>Telefon</option>
				<option value="Phone2" <?php if($preferences_orderByIdidentities_orderBy == 'Phone2'){echo 'selected';} ?>>Sekundær telefon</option>
				<option value="Email" <?php if($preferences_orderByIdidentities_orderBy == 'Email'){echo 'selected';} ?>>E-mail</option>
				<option value="Email2" <?php if($preferences_orderByIdidentities_orderBy == 'Email2'){echo 'selected';} ?>>Sekundær e-mail</option>
			</select><label for="inputOrderBy">Standardsortering</label><br>
		</div>
		
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Gem præferencer">
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