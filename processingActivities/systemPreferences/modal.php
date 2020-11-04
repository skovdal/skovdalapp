<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

$preferences_shortcutsProcessingActivities_shortcutsNew = getSystemPreferences('shortcutsProcessingActivities_shortcutsNew');
if($preferences_shortcutsProcessingActivities_shortcutsNew == -1){
	$preferences_shortcutsProcessingActivities_shortcutsNew = 1;
}

$preferences_shortcutsProcessingActivities_shortcutsUpdate = getSystemPreferences('shortcutsProcessingActivities_shortcutsUpdate');
if($preferences_shortcutsProcessingActivities_shortcutsUpdate == -1){
	$preferences_shortcutsProcessingActivities_shortcutsUpdate = 1;
}

$preferences_shortcutsProcessingActivities_shortcutsExport = getSystemPreferences('shortcutsProcessingActivities_shortcutsExport');
if($preferences_shortcutsProcessingActivities_shortcutsExport == -1){
	$preferences_shortcutsProcessingActivities_shortcutsExport = 0;
}

$preferences_shortcutsProcessingActivities_shortcutsTags = getSystemPreferences('shortcutsProcessingActivities_shortcutsTags');
if($preferences_shortcutsProcessingActivities_shortcutsTags == -1){
	$preferences_shortcutsProcessingActivities_shortcutsTags = 1;
}

$preferences_shortcutsProcessingActivities_shortcutsDelete = getSystemPreferences('shortcutsProcessingActivities_shortcutsDelete');
if($preferences_shortcutsProcessingActivities_shortcutsDelete == -1){
	$preferences_shortcutsProcessingActivities_shortcutsDelete = 0;
}

$preferences_columnsProcessingActivities_columnsName = getSystemPreferences('columnsProcessingActivities_columnsName');
if($preferences_columnsProcessingActivities_columnsName == -1){
	$preferences_columnsProcessingActivities_columnsName = 1;
}

$preferences_columnsProcessingActivities_columnsSecurityClearance = getSystemPreferences('columnsProcessingActivities_columnsSecurityClearance');
if($preferences_columnsProcessingActivities_columnsSecurityClearance == -1){
	$preferences_columnsProcessingActivities_columnsSecurityClearance = 0;
}

$preferences_columnsProcessingActivities_columnsEntityType = getSystemPreferences('columnsProcessingActivities_columnsEntityType');
if($preferences_columnsProcessingActivities_columnsEntityType == -1){
	$preferences_columnsProcessingActivities_columnsEntityType = 0;
}

$preferences_columnsProcessingActivities_columnsEntityName = getSystemPreferences('columnsProcessingActivities_columnsEntityName');
if($preferences_columnsProcessingActivities_columnsEntityName == -1){
	$preferences_columnsProcessingActivities_columnsEntityName = 1;
}

$preferences_columnsProcessingActivities_columnsEntityName2 = getSystemPreferences('columnsProcessingActivities_columnsEntityName2');
if($preferences_columnsProcessingActivities_columnsEntityName2 == -1){
	$preferences_columnsProcessingActivities_columnsEntityName2 = 0;
}

$preferences_columnsProcessingActivities_columnsEntityPhone = getSystemPreferences('columnsProcessingActivities_columnsEntityPhone');
if($preferences_columnsProcessingActivities_columnsEntityPhone == -1){
	$preferences_columnsProcessingActivities_columnsEntityPhone = 0;
}

$preferences_columnsProcessingActivities_columnsEntityEmail = getSystemPreferences('columnsProcessingActivities_columnsEntityEmail');
if($preferences_columnsProcessingActivities_columnsEntityEmail == -1){
	$preferences_columnsProcessingActivities_columnsEntityEmail = 0;
}

$preferences_columnsProcessingActivities_columnsTags = getSystemPreferences('columnsProcessingActivities_columnsTags');
if($preferences_columnsProcessingActivities_columnsTags == -1){
	$preferences_columnsProcessingActivities_columnsTags = 1;
}

$preferences_orderByProcessingActivities_orderBy = getSystemPreferences('orderByProcessingActivities_orderBy');
if($preferences_orderByProcessingActivities_orderBy == -1){
	$preferences_orderByProcessingActivities_orderBy = 'Name';
}

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if($validateFlag == 200){
?>
	<h1>Præferencer for behandlingsaktiviteter</h1>
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
	<form action="/processingActivities/systemPreferences/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div style="column-count:1;">
				<div class="checkbox <?php if($preferences_shortcutsProcessingActivities_shortcutsNew == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsNew" name="shortcutsNew" type="checkbox" value="1" <?php if($preferences_shortcutsProcessingActivities_shortcutsNew == 1){echo 'checked';} ?>><label for="inputShortcutsNew">Ny behandlingsaktivitet</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsProcessingActivities_shortcutsUpdate == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsUpdate" name="shortcutsUpdate" type="checkbox" value="1" <?php if($preferences_shortcutsProcessingActivities_shortcutsUpdate == 1){echo 'checked';} ?>><label for="inputShortcutsUpdate">Opdater behandlingsaktiviteter</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsProcessingActivities_shortcutsExport == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsExport" name="shortcutsExport" type="checkbox" value="1" <?php if($preferences_shortcutsProcessingActivities_shortcutsExport == 1){echo 'checked';} ?>><label for="inputShortcutsExport">Eksporter markerede behandlingsaktiviteter</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsProcessingActivities_shortcutsTags == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsTags" name="shortcutsTags" type="checkbox" value="1" <?php if($preferences_shortcutsProcessingActivities_shortcutsTags == 1){echo 'checked';} ?>><label for="inputShortcutsTags">Tilføj mærke på markerede behandlingsaktiviteter</label></div><br>
				<div class="checkbox <?php if($preferences_shortcutsProcessingActivities_shortcutsDelete == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputShortcutsDelete" name="shortcutsDelete" type="checkbox" value="1" <?php if($preferences_shortcutsProcessingActivities_shortcutsDelete == 1){echo 'checked';} ?>><label for="inputShortcutsDelete">Slet markerede behandlingsaktiviteter</label></div><br>
			</div>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div style="column-count:3;">
				<div class="checkbox <?php if($preferences_columnsProcessingActivities_columnsName == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsName" name="columnsName" type="checkbox" value="1" <?php if($preferences_columnsProcessingActivities_columnsName == 1){echo 'checked';} ?>><label for="inputColumnsName">Navn</label></div><br>
				<div class="checkbox <?php if($preferences_columnsProcessingActivities_columnsSecurityClearance == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsSecurityClearance" name="columnsSecurityClearance" type="checkbox" value="1" <?php if($preferences_columnsProcessingActivities_columnsSecurityClearance == 1){echo 'checked';} ?>><label for="inputColumnsSecurityClearance">Sikkerhedsgodkendelse</label></div><br>
				<div class="checkbox <?php if($preferences_columnsProcessingActivities_columnsEntityType == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsEntityType" name="columnsEntityType" type="checkbox" value="1" <?php if($preferences_columnsProcessingActivities_columnsEntityType == 1){echo 'checked';} ?>><label for="inputColumnsEntityType">Identitetstype</label></div><br>
				<div class="checkbox <?php if($preferences_columnsProcessingActivities_columnsEntityName == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsEntityName" name="columnsEntityName" type="checkbox" value="1" <?php if($preferences_columnsProcessingActivities_columnsEntity == 1){echo 'checked';} ?>><label for="inputColumnsEntity">Identitetsnavn</label></div><br>
				<div class="checkbox <?php if($preferences_columnsProcessingActivities_columnsEntityName2 == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsEntityName2" name="columnsEntityName2" type="checkbox" value="1" <?php if($preferences_columnsProcessingActivities_columnsEntityEntityName2 == 1){echo 'checked';} ?>><label for="inputColumnsEntityName2">Supplerende identitetsnavn</label></div><br>
				<div class="checkbox <?php if($preferences_columnsProcessingActivities_columnsEntityPhone == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsEntityPhone" name="columnsEntityPhone" type="checkbox" value="1" <?php if($preferences_columnsProcessingActivities_columnsEntityEntityPhone == 1){echo 'checked';} ?>><label for="inputColumnsEntityPhone">Identitetstelefon</label></div><br>
				<div class="checkbox <?php if($preferences_columnsProcessingActivities_columnsEntityEmail == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsEntityEmail" name="columnsEntityEmail" type="checkbox" value="1" <?php if($preferences_columnsProcessingActivities_columnsEntityEntityEmail == 1){echo 'checked';} ?>><label for="inputColumnsEntityEmail">Identitets-e-mail</label></div><br>
				<div class="checkbox <?php if($preferences_columnsProcessingActivities_columnsTags == 1){echo 'checked';}else{echo 'unchecked';} ?>" onclick="modalCheckbox(this);"><input id="inputColumnsTags" name="columnsTags" type="checkbox" value="1" <?php if($preferences_columnsProcessingActivities_columnsTags == 1){echo 'checked';} ?>><label for="inputColumnsTags">Mærker</label></div><br>
			</div>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<select id="inputOrderBy" name="orderBy" autofocus required>
				<option value="Name" <?php if($preferences_orderByProcessingActivities_orderBy == 'Name'){echo 'selected';} ?>>Navn</option>
				<option value="SecurityClearance" <?php if($preferences_orderByProcessingActivities_orderBy == 'SecurityClearance'){echo 'selected';} ?>>Sikkerhedsgodkendelse</option>
				<option value="Identities_type" <?php if($preferences_orderByProcessingActivities_orderBy == 'Identities_type'){echo 'selected';} ?>>Identitetstype</option>
				<option value="Identities_name" <?php if($preferences_orderByProcessingActivities_orderBy == 'Identities_name'){echo 'selected';} ?>>Identitetsnavn</option>
				<option value="Identities_name2" <?php if($preferences_orderByProcessingActivities_orderBy == 'Identities_name2'){echo 'selected';} ?>>Supplerende identitetsnavn</option>
				<option value="Identities_phone" <?php if($preferences_orderByProcessingActivities_orderBy == 'Identities_phone'){echo 'selected';} ?>>Identitetstelefon</option>
				<option value="Identities_email" <?php if($preferences_orderByProcessingActivities_orderBy == 'Identities_email'){echo 'selected';} ?>>Identitets-e-mail</option>
			</select><label for="inputOrderBy">Standardsortering</label><br>
		</div>
		
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Gem præferencer">
		</div>
	</form>
	<?php
	if(getSystemConfigurations('logProcessingActivities') == 1 || getSystemConfigurations('logProcessingActivities') == -1){
		$type = 'view';
		$processingActivities_id = $_SESSION['processingActivities_id'];
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
		
		addSystemEvent(
			$processingActivities_id,
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
			$fileName
		);
	}
}
else{
	if(getSystemConfigurations('logProcessingActivities') == 1 || getSystemConfigurations('logProcessingActivities') == -1){
		$type = 'view';
		$processingActivities_id = $_SESSION['processingActivities_id'];
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
		
		addSystemEvent(
			$processingActivities_id,
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
			$fileName
		);
	}
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>