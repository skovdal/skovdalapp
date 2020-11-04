<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

$preferences_shortcutsFiles_shortcutsNew = getSystemPreferences('shortcutsFiles_shortcutsNew');
if($preferences_shortcutsFiles_shortcutsNew == -1){
	$preferences_shortcutsFiles_shortcutsNew = 1;
}

$preferences_shortcutsFiles_shortcutsUpdate = getSystemPreferences('shortcutsFiles_shortcutsUpdate');
if($preferences_shortcutsFiles_shortcutsUpdate == -1){
	$preferences_shortcutsFiles_shortcutsUpdate = 1;
}

$preferences_shortcutsFiles_shortcutsExport = getSystemPreferences('shortcutsFiles_shortcutsExport');
if($preferences_shortcutsFiles_shortcutsExport == -1){
	$preferences_shortcutsFiles_shortcutsExport = 0;
}

$preferences_shortcutsFiles_shortcutsTags = getSystemPreferences('shortcutsFiles_shortcutsTags');
if($preferences_shortcutsFiles_shortcutsTags == -1){
	$preferences_shortcutsFiles_shortcutsTags = 1;
}

$preferences_shortcutsFiles_shortcutsDelete = getSystemPreferences('shortcutsFiles_shortcutsDelete');
if($preferences_shortcutsFiles_shortcutsDelete == -1){
	$preferences_shortcutsFiles_shortcutsDelete = 0;
}

$preferences_columnsFiles_columnsType = getSystemPreferences('columnsFiles_columnsType');
if($preferences_columnsFiles_columnsType == -1){
	$preferences_columnsFiles_columnsType = 1;
}

$preferences_columnsFiles_columnsName = getSystemPreferences('columnsFiles_columnsName');
if($preferences_columnsFiles_columnsName == -1){
	$preferences_columnsFiles_columnsName = 1;
}

$preferences_columnsFiles_columnsSize = getSystemPreferences('columnsFiles_columnsSize');
if($preferences_columnsFiles_columnsSize == -1){
	$preferences_columnsFiles_columnsSize = 1;
}

$preferences_columnsFiles_columnsLastModified = getSystemPreferences('columnsFiles_columnsLastModified');
if($preferences_columnsFiles_columnsLastModified == -1){
	$preferences_columnsFiles_columnsLastModified = 0;
}

$preferences_columnsFiles_columnsTags = getSystemPreferences('columnsFiles_columnsTags');
if($preferences_columnsFiles_columnsTags == -1){
	$preferences_columnsFiles_columnsTags = 1;
}

$preferences_orderByFiles_orderBy = getSystemPreferences('orderByFiles_orderBy');
if($preferences_orderByFiles_orderBy == -1){
	$preferences_orderByFiles_orderBy = 'Name';
}

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if($validateFlag == 200){
?>
	<h1>Præferencer for filer</h1>
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
	<form action="/files/systemPreferences/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div style="column-count:1;">
				<div class="checkbox <?php if($preferences_shortcutsFiles_shortcutsNew == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsNew" name="shortcutsNew" type="checkbox" value="1" <?php if($preferences_shortcutsFiles_shortcutsNew == 1){echo 'checked';} ?>><label for="inputShortcutsNew">Nye filer</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsFiles_shortcutsUpdate == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsUpdate" name="shortcutsUpdate" type="checkbox" value="1" <?php if($preferences_shortcutsFiles_shortcutsUpdate == 1){echo 'checked';} ?>><label for="inputShortcutsUpdate">Opdater filer</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsFiles_shortcutsExport == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsExport" name="shortcutsExport" type="checkbox" value="1" <?php if($preferences_shortcutsFiles_shortcutsExport == 1){echo 'checked';} ?>><label for="inputShortcutsExport">Eksporter markerede filer</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsFiles_shortcutsTags == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsTags" name="shortcutsTags" type="checkbox" value="1" <?php if($preferences_shortcutsFiles_shortcutsTags == 1){echo 'checked';} ?>><label for="inputShortcutsTags">Tilføj mærke på markerede filer</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsFiles_shortcutsDelete == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsDelete" name="shortcutsDelete" type="checkbox" value="1" <?php if($preferences_shortcutsFiles_shortcutsDelete == 1){echo 'checked';} ?>><label for="inputShortcutsDelete">Slet markerede filer</label></div><br>
			</div>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div style="column-count:3;">
				<div class="checkbox <?php if($preferences_columnsFiles_columnsType == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsType" name="columnsType" type="checkbox" value="1" <?php if($preferences_columnsFiles_columnsType == 1){echo 'checked';} ?>><label for="inputColumnsType">Type</label></div><br>
				<div class="checkbox <?php if($preferences_columnsFiles_columnsName == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsName" name="columnsName" type="checkbox" value="1" <?php if($preferences_columnsFiles_columnsName == 1){echo 'checked';} ?>><label for="inputColumnsName">Navn</label></div><br>
				<div class="checkbox <?php if($preferences_columnsFiles_columnsSize == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsSize" name="columnsSize" type="checkbox" value="1" <?php if($preferences_columnsFiles_columnsSize == 1){echo 'checked';} ?>><label for="inputColumnsSize">Størrelse</label></div><br>
				<div class="checkbox <?php if($preferences_columnsFiles_columnsLastModified == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsLastModified" name="columnsLastModified" type="checkbox" value="1" <?php if($preferences_columnsFiles_columnsLastModified == 1){echo 'checked';} ?>><label for="inputColumnsLastModified">Seneste ændring</label></div><br>
				<div class="checkbox <?php if($preferences_columnsFiles_columnsTags == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsTags" name="columnsTags" type="checkbox" value="1" <?php if($preferences_columnsFiles_columnsTags == 1){echo 'checked';} ?>><label for="inputColumnsTags">Mærker</label></div><br>
			</div>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<select id="inputOrderBy" name="orderBy" autofocus required>
				<option value="Type" <?php if($preferences_orderByFiles_orderBy == 'Type'){echo 'selected';} ?>>Type</option>
				<option value="Name" <?php if($preferences_orderByFiles_orderBy == 'Name'){echo 'selected';} ?>>Navn</option>
				<option value="Size" <?php if($preferences_orderByFiles_orderBy == 'Size'){echo 'selected';} ?>>Størrelse</option>
				<option value="LastModified" <?php if($preferences_orderByFiles_orderBy == 'LastModified'){echo 'selected';} ?>>Seneste ændring</option>
			</select><label for="inputOrderBy">Standardsortering</label><br>
		</div>
		
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Gem præferencer">
		</div>
	</form>
	<?php
	if(getSystemConfigurations('logFiles') == 1 || getSystemConfigurations('logFiles') == -1){
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
	if(getSystemConfigurations('logFiles') == 1 || getSystemConfigurations('logFiles') == -1){
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