<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

$preferences_shortcutsSystemStorages_shortcutsNew = getSystemPreferences('shortcutsSystemStorages_shortcutsNew');
if($preferences_shortcutsSystemStorages_shortcutsNew == -1){
	$preferences_shortcutsSystemStorages_shortcutsNew = 1;
}

$preferences_shortcutsSystemStorages_shortcutsUpdate = getSystemPreferences('shortcutsSystemStorages_shortcutsUpdate');
if($preferences_shortcutsSystemStorages_shortcutsUpdate == -1){
	$preferences_shortcutsSystemStorages_shortcutsUpdate = 1;
}

$preferences_shortcutsSystemStorages_shortcutsExport = getSystemPreferences('shortcutsSystemStorages_shortcutsExport');
if($preferences_shortcutsSystemStorages_shortcutsExport == -1){
	$preferences_shortcutsSystemStorages_shortcutsExport = 0;
}

$preferences_shortcutsSystemStorages_shortcutsTags = getSystemPreferences('shortcutsSystemStorages_shortcutsTags');
if($preferences_shortcutsSystemStorages_shortcutsTags == -1){
	$preferences_shortcutsSystemStorages_shortcutsTags = 1;
}

$preferences_shortcutsSystemStorages_shortcutsDelete = getSystemPreferences('shortcutsSystemStorages_shortcutsDelete');
if($preferences_shortcutsSystemStorages_shortcutsDelete == -1){
	$preferences_shortcutsSystemStorages_shortcutsDelete = 0;
}

$preferences_columnsSystemStorages_columnsConnectionStatus = getSystemPreferences('columnsSystemStorages_columnsConnectionStatus');
if($preferences_columnsSystemStorages_columnsConnectionStatus == -1){
	$preferences_columnsSystemStorages_columnsConnectionStatus = 1;
}

$preferences_columnsSystemStorages_columnsName = getSystemPreferences('columnsSystemStorages_columnsName');
if($preferences_columnsSystemStorages_columnsName == -1){
	$preferences_columnsSystemStorages_columnsName = 1;
}

$preferences_columnsSystemStorages_columnsType = getSystemPreferences('columnsSystemStorages_columnsType');
if($preferences_columnsSystemStorages_columnsType == -1){
	$preferences_columnsSystemStorages_columnsType = 1;
}

$preferences_columnsSystemStorages_columnsStorageSize = getSystemPreferences('columnsSystemStorages_columnsStorageSize');
if($preferences_columnsSystemStorages_columnsStorageSize == -1){
	$preferences_columnsSystemStorages_columnsStorageSize = 1;
}

$preferences_columnsSystemStorages_columnsTags = getSystemPreferences('columnsSystemStorages_columnsTags');
if($preferences_columnsSystemStorages_columnsTags == -1){
	$preferences_columnsSystemStorages_columnsTags = 1;
}

$preferences_orderBySystemStorages_orderBy = getSystemPreferences('orderBySystemStorages_orderBy');
if($preferences_orderBySystemStorages_orderBy == -1){
	$preferences_orderBySystemStorages_orderBy = 'Name';
}

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if($validateFlag == 200){
?>
	<h1>Præferencer for systemlagre</h1>
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
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 4);">
			Sortering
		</li>
	</ul>
	<form action="/systemStorages/systemPreferences/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div style="column-count:1;">
				<div class="checkbox <?php if($preferences_shortcutsSystemStorages_shortcutsNew == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsNew" name="shortcutsNew" type="checkbox" value="1" <?php if($preferences_shortcutsSystemStorages_shortcutsNew == 1){echo 'checked';} ?>><label for="inputShortcutsNew">Nyt systemlager</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsSystemStorages_shortcutsUpdate == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsUpdate" name="shortcutsUpdate" type="checkbox" value="1" <?php if($preferences_shortcutsSystemStorages_shortcutsUpdate == 1){echo 'checked';} ?>><label for="inputShortcutsUpdate">Opdater systemlagre</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsSystemStorages_shortcutsExport == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsExport" name="shortcutsExport" type="checkbox" value="1" <?php if($preferences_shortcutsSystemStorages_shortcutsExport == 1){echo 'checked';} ?>><label for="inputShortcutsExport">Eksporter markerede systemlagre</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsSystemStorages_shortcutsTags == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsTags" name="shortcutsTags" type="checkbox" value="1" <?php if($preferences_shortcutsSystemStorages_shortcutsTags == 1){echo 'checked';} ?>><label for="inputShortcutsTags">Tilføj mærke på markerede systemlagre</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsSystemStorages_shortcutsDelete == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsDelete" name="shortcutsDelete" type="checkbox" value="1" <?php if($preferences_shortcutsSystemStorages_shortcutsDelete == 1){echo 'checked';} ?>><label for="inputShortcutsDelete">Slet markerede systemlagre</label></div><br>
			</div>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div style="column-count:3;">
				<div class="checkbox <?php if($preferences_columnsSystemStorages_columnsName == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsName" name="columnsName" type="checkbox" value="1" <?php if($preferences_columnsSystemStorages_columnsName == 1){echo 'checked';} ?>><label for="inputColumnsName">Navn</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemStorages_columnsType == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsType" name="columnsType" type="checkbox" value="1" <?php if($preferences_columnsSystemStorages_columnsType == 1){echo 'checked';} ?>><label for="inputColumnsType">Type</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemStorages_columnsStorageSize == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsStorageSize" name="columnsStorageSize" type="checkbox" value="1" <?php if($preferences_columnsSystemStorages_columnsStorageSize == 1){echo 'checked';} ?>><label for="inputColumnsStorageSize">Lagerstørrelse</label></div><br>
				<div class="checkbox <?php if($preferences_columnsSystemStorages_columnsTags == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsTags" name="columnsTags" type="checkbox" value="1" <?php if($preferences_columnsSystemStorages_columnsTags == 1){echo 'checked';} ?>><label for="inputColumnsTags">Mærker</label></div><br>
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
				<option value="ConnectionStatus" <?php if($preferences_orderBySystemStorages_orderBy == 'ConnectionStatus'){echo 'selected';} ?>>Forbindelsesstatus</option>
				<option value="Name" <?php if($preferences_orderBySystemStorages_orderBy == 'Name'){echo 'selected';} ?>>Navn</option>
				<option value="Type" <?php if($preferences_orderBySystemStorages_orderBy == 'Type'){echo 'selected';} ?>>Type</option>
				<option value="StorageSize" <?php if($preferences_orderBySystemStorages_orderBy == 'StorageSize'){echo 'selected';} ?>>Lagerstørrelse</option>
			</select><label for="inputOrderBy">Standardsortering</label><br>
		</div>
		
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Gem præferencer">
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