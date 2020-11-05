<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

$preferences_shortcutsSystemNotifications_shortcutsUpdate = getSystemPreferences('shortcutsSystemNotifications_shortcutsUpdate');
if($preferences_shortcutsSystemNotifications_shortcutsUpdate == -1){
	$preferences_shortcutsSystemNotifications_shortcutsUpdate = 1;
}

$preferences_shortcutsSystemNotifications_shortcutsExport = getSystemPreferences('shortcutsSystemNotifications_shortcutsExport');
if($preferences_shortcutsSystemNotifications_shortcutsExport == -1){
	$preferences_shortcutsSystemNotifications_shortcutsExport = 0;
}

$preferences_shortcutsSystemNotifications_shortcutsTags = getSystemPreferences('shortcutsSystemNotifications_shortcutsTags');
if($preferences_shortcutsSystemNotifications_shortcutsTags == -1){
	$preferences_shortcutsSystemNotifications_shortcutsTags = 1;
}

$preferences_columnsSystemNotifications_columnsType = getSystemPreferences('columnsSystemNotifications_columnsType');
if($preferences_columnsSystemNotifications_columnsType == -1){
	$preferences_columnsSystemNotifications_columnsType = 1;
}

$preferences_columnsSystemNotifications_columnsTitle = getSystemPreferences('columnsSystemNotifications_columnsTitle');
if($preferences_columnsSystemNotifications_columnsTitle == -1){
	$preferences_columnsSystemNotifications_columnsTitle = 1;
}

$preferences_columnsSystemNotifications_columnsMsg = getSystemPreferences('columnsSystemNotifications_columnsMsg');
if($preferences_columnsSystemNotifications_columnsMsg == -1){
	$preferences_columnsSystemNotifications_columnsMsg = 0;
}

$preferences_columnsSystemNotifications_columnsSystemUsers_name = getSystemPreferences('columnsSystemNotifications_columnsSystemUsers_name');
if($preferences_columnsSystemNotifications_columnsSystemUsers_name == -1){
	$preferences_columnsSystemNotifications_columnsSystemUsers_name = 1;
}

$preferences_columnsSystemNotifications_columnsDate = getSystemPreferences('columnsSystemNotifications_columnsDate');
if($preferences_columnsSystemNotifications_columnsDate == -1){
	$preferences_columnsSystemNotifications_columnsDate = 1;
}

$preferences_columnsSystemNotifications_columnsIpAddress = getSystemPreferences('columnsSystemNotifications_columnsIpAddress');
if($preferences_columnsSystemNotifications_columnsIpAddress == -1){
	$preferences_columnsSystemNotifications_columnsIpAddress = 0;
}

$preferences_columnsSystemNotifications_columnsTags = getSystemPreferences('columnsSystemNotifications_columnsTags');
if($preferences_columnsSystemNotifications_columnsTags == -1){
	$preferences_columnsSystemNotifications_columnsTags = 1;
}

$preferences_orderBySystemNotifications_orderBy = getSystemPreferences('orderBySystemNotifications_orderBy');
if($preferences_orderBySystemNotifications_orderBy == -1){
	$preferences_orderBySystemNotifications_orderBy = 'Date';
}

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if($validateFlag == 200){
?>
	<h1>Præferencer for systemnotifikationer</h1>
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
	<form action="/systemNotifications/systemPreferences/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div style="column-count:1;">
				<div class="checkbox <?php if($preferences_shortcutsSystemNotifications_shortcutsUpdate == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsUpdate" name="shortcutsUpdate" type="checkbox" value="1" <?php if($preferences_shortcutsSystemNotifications_shortcutsUpdate == 1){echo 'checked';} ?>><label for="inputShortcutsUpdate">Opdater systemnotifikationer</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsSystemNotifications_shortcutsExport == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsExport" name="shortcutsExport" type="checkbox" value="1" <?php if($preferences_shortcutsSystemNotifications_shortcutsExport == 1){echo 'checked';} ?>><label for="inputShortcutsExport">Eksporter markerede systemnotifikationer</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsSystemNotifications_shortcutsTags == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsTags" name="shortcutsTags" type="checkbox" value="1" <?php if($preferences_shortcutsSystemNotifications_shortcutsTags == 1){echo 'checked';} ?>><label for="inputShortcutsTags">Tilføj mærke på markerede systemnotifikationer</label></div><br>
			</div>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div style="column-count:3;">
				<div class="checkbox <?php if($preferences_columnsSystemNotifications_columnsType == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsType" name="columnsType" type="checkbox" value="1" <?php if($preferences_columnsSystemNotifications_columnsType == 1){echo 'checked';} ?>><label for="inputColumnsType">Type</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemNotifications_columnsTitle == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsTitle" name="columnsTitle" type="checkbox" value="1" <?php if($preferences_columnsSystemNotifications_columnsTitle == 1){echo 'checked';} ?>><label for="inputColumnsTitle">Titel</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemNotifications_columnsMsg == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsMsg" name="columnsMsg" type="checkbox" value="1" <?php if($preferences_columnsSystemNotifications_columnsMsg == 1){echo 'checked';} ?>><label for="inputColumnsMsg">Besked</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemNotifications_columnsSystemUsers_name == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsSystemUsers_name" name="columnsSystemUsers_name" type="checkbox" value="1" <?php if($preferences_columnsSystemNotifications_columnsSystemUsers_name == 1){echo 'checked';} ?>><label for="inputColumnsSystemUsers_name">Bruger</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemNotifications_columnsDate == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsDate" name="columnsDate" type="checkbox" value="1" <?php if($preferences_columnsSystemNotifications_columnsDate == 1){echo 'checked';} ?>><label for="inputColumnsDate">Dato</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemNotifications_columnsIpAddress == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsIpAddress" name="columnsIpAddress" type="checkbox" value="1" <?php if($preferences_columnsSystemNotifications_columnsIpAddress == 1){echo 'checked';} ?>><label for="inputColumnsIpAddress">IP-adresse</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemNotifications_columnsTags == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsTags" name="columnsTags" type="checkbox" value="1" <?php if($preferences_columnsSystemNotifications_columnsTags == 1){echo 'checked';} ?>><label for="inputColumnsTags">Mærker</label></div><br>
			</div>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<select id="inputOrderBy" name="orderBy" autofocus required>
				<option value="Type" <?php if($preferences_orderBySystemNotifications_orderBy == 'Type'){echo 'selected';} ?>>Type</option>
				<option value="Title" <?php if($preferences_orderBySystemNotifications_orderBy == 'Title'){echo 'selected';} ?>>Titel</option>
				<option value="Msg" <?php if($preferences_orderBySystemNotifications_orderBy == 'Msg'){echo 'selected';} ?>>Besked</option>
				<option value="SystemUsers_name" <?php if($preferences_orderBySystemNotifications_orderBy == 'SystemUsers_name'){echo 'selected';} ?>>Bruger</option>
				<option value="Date" <?php if($preferences_orderBySystemNotifications_orderBy == 'Date'){echo 'selected';} ?>>Dato</option>
				<option value="IpAddress" <?php if($preferences_orderBySystemNotifications_orderBy == 'IpAddress'){echo 'selected';} ?>>IP-adresse</option>
			</select><label for="inputOrderBy">Standardsortering</label><br>
		</div>
		
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Gem præferencer">
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
	
	httpStatusCodes($validateFlag);
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>