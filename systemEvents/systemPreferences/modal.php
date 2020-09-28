<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

$preferences_shortcutsSystemEvents_shortcutsUpdate = getSystemPreferences('shortcutsSystemEvents_shortcutsUpdate');
if($preferences_shortcutsSystemEvents_shortcutsUpdate == -1){
	$preferences_shortcutsSystemEvents_shortcutsUpdate = 1;
}

$preferences_shortcutsSystemEvents_shortcutsExport = getSystemPreferences('shortcutsSystemEvents_shortcutsExport');
if($preferences_shortcutsSystemEvents_shortcutsExport == -1){
	$preferences_shortcutsSystemEvents_shortcutsExport = 0;
}

$preferences_shortcutsSystemEvents_shortcutsTags = getSystemPreferences('shortcutsSystemEvents_shortcutsTags');
if($preferences_shortcutsSystemEvents_shortcutsTags == -1){
	$preferences_shortcutsSystemEvents_shortcutsTags = 1;
}

$preferences_columnsSystemEvents_columnsType = getSystemPreferences('columnsSystemEvents_columnsType');
if($preferences_columnsSystemEvents_columnsType == -1){
	$preferences_columnsSystemEvents_columnsType = 1;
}

$preferences_columnsSystemEvents_columnsIpAddress = getSystemPreferences('columnsSystemEvents_columnsIpAddress');
if($preferences_columnsSystemEvents_columnsIpAddress == -1){
	$preferences_columnsSystemEvents_columnsIpAddress = 0;
}

$preferences_columnsSystemEvents_columnsStartTime = getSystemPreferences('columnsSystemEvents_columnsStartTime');
if($preferences_columnsSystemEvents_columnsStartTime == -1){
	$preferences_columnsSystemEvents_columnsStartTime = 1;
}

$preferences_columnsSystemEvents_columnsEndTime = getSystemPreferences('columnsSystemEvents_columnsEndTime');
if($preferences_columnsSystemEvents_columnsEndTime == -1){
	$preferences_columnsSystemEvents_columnsEndTime = 0;
}

$preferences_columnsSystemEvents_columnsFinished = getSystemPreferences('columnsSystemEvents_columnsFinished');
if($preferences_columnsSystemEvents_columnsFinished == -1){
	$preferences_columnsSystemEvents_columnsFinished = 1;
}

$preferences_columnsSystemEvents_columnsHost = getSystemPreferences('columnsSystemEvents_columnsHost');
if($preferences_columnsSystemEvents_columnsHost == -1){
	$preferences_columnsSystemEvents_columnsHost = 1;
}

$preferences_columnsSystemEvents_columnsHttpVersion = getSystemPreferences('columnsSystemEvents_columnsHttpVersion');
if($preferences_columnsSystemEvents_columnsHttpVersion == -1){
	$preferences_columnsSystemEvents_columnsHttpVersion = 1;
}

$preferences_columnsSystemEvents_columnsInstanceId = getSystemPreferences('columnsSystemEvents_columnsInstanceId');
if($preferences_columnsSystemEvents_columnsInstanceId == -1){
	$preferences_columnsSystemEvents_columnsInstanceId = 1;
}

$preferences_columnsSystemEvents_columnsMethod = getSystemPreferences('columnsSystemEvents_columnsMethod');
if($preferences_columnsSystemEvents_columnsMethod == -1){
	$preferences_columnsSystemEvents_columnsMethod = 1;
}

$preferences_columnsSystemEvents_columnsStatus = getSystemPreferences('columnsSystemEvents_columnsStatus');
if($preferences_columnsSystemEvents_columnsStatus == -1){
	$preferences_columnsSystemEvents_columnsStatus = 1;
}

$preferences_columnsSystemEvents_columnsUserAgent = getSystemPreferences('columnsSystemEvents_columnsUserAgent');
if($preferences_columnsSystemEvents_columnsUserAgent == -1){
	$preferences_columnsSystemEvents_columnsUserAgent = 1;
}

$preferences_columnsSystemEvents_columnsVersion = getSystemPreferences('columnsSystemEvents_columnsVersion');
if($preferences_columnsSystemEvents_columnsVersion == -1){
	$preferences_columnsSystemEvents_columnsVersion = 1;
}

$preferences_columnsSystemEvents_columnsHttpsEnabled = getSystemPreferences('columnsSystemEvents_columnsHttpsEnabled');
if($preferences_columnsSystemEvents_columnsHttpsEnabled == -1){
	$preferences_columnsSystemEvents_columnsHttpsEnabled = 1;
}

$preferences_columnsSystemEvents_columnsFileName = getSystemPreferences('columnsSystemEvents_columnsFileName');
if($preferences_columnsSystemEvents_columnsFileName == -1){
	$preferences_columnsSystemEvents_columnsFileName = 1;
}

$preferences_columnsSystemEvents_columnsSystemUsers_name = getSystemPreferences('columnsSystemEvents_columnsSystemUsers_name');
if($preferences_columnsSystemEvents_columnsSystemUsers_name == -1){
	$preferences_columnsSystemEvents_columnsSystemUsers_name = 1;
}

$preferences_columnsSystemEvents_columnsTags = getSystemPreferences('columnsSystemEvents_columnsTags');
if($preferences_columnsSystemEvents_columnsTags == -1){
	$preferences_columnsSystemEvents_columnsTags = 1;
}

$preferences_orderBySystemEvents_orderBy = getSystemPreferences('orderBySystemEvents_orderBy');
if($preferences_orderBySystemEvents_orderBy == -1){
	$preferences_orderBySystemEvents_orderBy = 'Date';
}

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if($validateFlag == 200){
?>
	<h1>Præferencer for systemhændelser</h1>
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
	<form action="/systemEvents/systemPreferences/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div style="column-count:1;">
				<div class="checkbox <?php if($preferences_shortcutsSystemEvents_shortcutsUpdate == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsUpdate" name="shortcutsUpdate" type="checkbox" value="1" <?php if($preferences_shortcutsSystemEvents_shortcutsUpdate == 1){echo 'checked';} ?>><label for="inputShortcutsUpdate">Opdater systemhændelser</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsSystemEvents_shortcutsExport == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsExport" name="shortcutsExport" type="checkbox" value="1" <?php if($preferences_shortcutsSystemEvents_shortcutsExport == 1){echo 'checked';} ?>><label for="inputShortcutsExport">Eksporter markerede systemhændelser</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsSystemEvents_shortcutsTags == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsTags" name="shortcutsTags" type="checkbox" value="1" <?php if($preferences_shortcutsSystemEvents_shortcutsTags == 1){echo 'checked';} ?>><label for="inputShortcutsTags">Tilføj mærke på markerede systemhændelser</label></div><br>
			</div>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div style="column-count:3;">
				<div class="checkbox <?php if($preferences_columnsSystemEvents_columnsType == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsType" name="columnsType" type="checkbox" value="1" <?php if($preferences_columnsSystemEvents_columnsType == 1){echo 'checked';} ?>><label for="inputcolumnsType">Type</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemEvents_columnsStartTime == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsStartTime" name="columnsStartTime" type="checkbox" value="1" <?php if($preferences_columnsSystemEvents_columnsStartTime == 1){echo 'checked';} ?>><label for="inputcolumnsStartTime">Starttid</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemEvents_columnsEndTime == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsEndTime" name="columnsEndTime" type="checkbox" value="1" <?php if($preferences_columnsSystemEvents_columnsEndTime == 1){echo 'checked';} ?>><label for="inputcolumnsEndTime">Sluttid</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemEvents_columnsStatus == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsStatus" name="columnsStatus" type="checkbox" value="1" <?php if($preferences_columnsSystemEvents_columnsStatus == 1){echo 'checked';} ?>><label for="inputcolumnsStatus">Status</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemEvents_columnsFinished == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsFinished" name="columnsFinished" type="checkbox" value="1" <?php if($preferences_columnsSystemEvents_columnsFinished == 1){echo 'checked';} ?>><label for="inputcolumnsFinished">Afsluttet</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemEvents_columnsIpAddress == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsIpAddress" name="columnsIpAddress" type="checkbox" value="1" <?php if($preferences_columnsSystemEvents_columnsIpAddress == 1){echo 'checked';} ?>><label for="inputcolumnsIpAddress">IP-adresse</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemEvents_columnsHost == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsHost" name="columnsHost" type="checkbox" value="1" <?php if($preferences_columnsSystemEvents_columnsHost == 1){echo 'checked';} ?>><label for="inputcolumnsHost">Vært</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemEvents_columnsHttpVersion == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsHttpVersion" name="columnsHttpVersion" type="checkbox" value="1" <?php if($preferences_columnsSystemEvents_columnsHttpVersion == 1){echo 'checked';} ?>><label for="inputcolumnsHttpVersion">HTTP-version</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemEvents_columnsInstanceId == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsInstanceId" name="columnsInstanceId" type="checkbox" value="1" <?php if($preferences_columnsSystemEvents_columnsInstanceId == 1){echo 'checked';} ?>><label for="inputcolumnsInstanceId">Sessionsid</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemEvents_columnsMethod == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsMethod" name="columnsMethod" type="checkbox" value="1" <?php if($preferences_columnsSystemEvents_columnsMethod == 1){echo 'checked';} ?>><label for="inputcolumnsMethod">Metode</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemEvents_columnsUserAgent == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsUserAgent" name="columnsUserAgent" type="checkbox" value="1" <?php if($preferences_columnsSystemEvents_columnsUserAgent == 1){echo 'checked';} ?>><label for="inputcolumnsUserAgent">Brugeragent</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemEvents_columnsHttpsEnabled == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsHttpsEnabled" name="columnsHttpsEnabled" type="checkbox" value="1" <?php if($preferences_columnsSystemEvents_columnsHttpsEnabled == 1){echo 'checked';} ?>><label for="inputcolumnsHttpsEnabled">HTTPS</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemEvents_columnsFileName == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsFileName" name="columnsFileName" type="checkbox" value="1" <?php if($preferences_columnsSystemEvents_columnsFileName == 1){echo 'checked';} ?>><label for="inputcolumnsFileName">Filnavn</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemEvents_columnsVersion == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsVersion" name="columnsVersion" type="checkbox" value="1" <?php if($preferences_columnsSystemEvents_columnsVersion == 1){echo 'checked';} ?>><label for="inputcolumnsVersion">Version</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemEvents_columnsTags == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputcolumnsTags" name="columnsTags" type="checkbox" value="1" <?php if($preferences_columnsSystemEvents_columnsTags == 1){echo 'checked';} ?>><label for="inputcolumnsTags">Mærker</label></div><br>
			</div>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<select id="inputOrderBy" name="orderBy" autofocus required>
				<option value="Type" <?php if($preferences_orderBySystemEvents_orderBy == 'Type'){echo 'selected';} ?>>Type</option>
				<option value="StartTime" <?php if($preferences_orderBySystemEvents_orderBy == 'StartTime'){echo 'selected';} ?>>Starttid</option>
				<option value="EndTime" <?php if($preferences_orderBySystemEvents_orderBy == 'EndTime'){echo 'selected';} ?>>Sluttid</option>
				<option value="Status" <?php if($preferences_orderBySystemEvents_orderBy == 'Status'){echo 'selected';} ?>>Status</option>
				<option value="Finished" <?php if($preferences_orderBySystemEvents_orderBy == 'Finished'){echo 'selected';} ?>>Afsluttet</option>
				<option value="IpAddress" <?php if($preferences_orderBySystemEvents_orderBy == 'IpAddress'){echo 'selected';} ?>>IP-adresse</option>
				<option value="Host" <?php if($preferences_orderBySystemEvents_orderBy == 'Host'){echo 'selected';} ?>>Vært</option>
				<option value="HttpVersion" <?php if($preferences_orderBySystemEvents_orderBy == 'HttpVersion'){echo 'selected';} ?>>HTTP-version</option>
				<option value="InstanceId" <?php if($preferences_orderBySystemEvents_orderBy == 'InstanceId'){echo 'selected';} ?>>Sessionsid</option>
				<option value="Method" <?php if($preferences_orderBySystemEvents_orderBy == 'Method'){echo 'selected';} ?>>Metode</option>
				<option value="UserAgent" <?php if($preferences_orderBySystemEvents_orderBy == 'UserAgent'){echo 'selected';} ?>>Brugeragent</option>
				<option value="HttpsEnabled" <?php if($preferences_orderBySystemEvents_orderBy == 'HttpsEnabled'){echo 'selected';} ?>>HTTPS</option>
				<option value="FileName" <?php if($preferences_orderBySystemEvents_orderBy == 'FileName'){echo 'selected';} ?>>Filnavn</option>
				<option value="Version" <?php if($preferences_orderBySystemEvents_orderBy == 'Version'){echo 'selected';} ?>>Version</option>
			</select><label for="inputOrderBy">Standardsortering</label><br>
		</div>
		
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Gem præferencer">
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
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>