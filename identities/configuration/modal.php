<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

$configuration_encryptionIdidentities = getSystemConfigurations('encryptionIdidentities');
if($configuration_encryptionIdidentities == -1){
	$configuration_encryptionIdidentities = 0;
}
$configuration_logIdidentities = getSystemConfigurations('logIdidentities');
if($configuration_logIdidentities == -1){
	$configuration_logIdidentities = 1;
}
$configuration_deleteConfirmationIdidentities = getSystemConfigurations('deleteConfirmationIdidentities');
if($configuration_deleteConfirmationIdidentities == -1){
	$configuration_deleteConfirmationIdidentities = 1;
}

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if($validateFlag == 200){
?>
	<h1>Sikkerhedsindstillinger for identiteter</h1>
	<ul>
		<li class="active" onclick="modalTab('<?php echo purify($modalId); ?>', 1);">
			Kryptering
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 2);">
			Logning
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 3);">
			Sletning
		</li>
	</ul>
	<form action="/identities/configuration/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<div>
			Det er muligt at kryptere alle opbevarede data om identiteter.<br>
			<br>
			Complian anbefaler kraftigt, at du inden en eventuel aktivering sætter dig ind i følgerne af at gøre brug af funktionen.<br>
			<br>
			<a href="https://www.complian.com.complian.dev/support/da-DK/" target="_blank">Klik her for yderligere information om funktionen</a><br>
			<br>
			<select id="inputEncryptionIdidentities" name="encryptionIdidentities" autofocus required>
				<option value="1" <?php if($configuration_encryptionIdidentities == 1){echo 'selected';} ?>>Krypter opbevarede data om identiteter</option>
				<option value="0" <?php if($configuration_encryptionIdidentities == 0){echo 'selected';} ?>>Krypter ikke opbevarede data om identiteter</option>
			</select><label for="inputEncryptionIdidentities">Kryptering ved opbevaring</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<select id="inputLogIdidentities" name="logIdidentities" autofocus required>
				<option value="1" <?php if($configuration_logIdidentities == 1){echo 'selected';} ?>>Log hændelser om identiteter</option>
				<option value="0" <?php if($configuration_logIdidentities == 0){echo 'selected';} ?>>Log ikke hændelser om identiteter</option>
			</select><label for="inputLogIdidentities">Logning af hændelser</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<select id="inputDeleteConfirmationIdidentities" name="deleteConfirmationIdidentities" autofocus required>
				<option value="9" <?php if($configuration_deleteConfirmationIdidentities == 9){echo 'selected';} ?>>Benyt Complian-appen til bekræftelse fra en anden enhed</option>
				<option value="2" <?php if($configuration_deleteConfirmationIdidentities == 2){echo 'selected';} ?>>Benyt brugerens adgangskode til bekræftelse</option>
				<option value="1" <?php if($configuration_deleteConfirmationIdidentities == 1){echo 'selected';} ?>>Benyt tryk på knap til bekræftelse</option>
				<option value="3" <?php if($configuration_deleteConfirmationIdidentities == 3){echo 'selected';} ?>>Benyt en bekræftelseskode som findes på et fysisk nøglekort</option>
				<option value="8" <?php if($configuration_deleteConfirmationIdidentities == 8){echo 'selected';} ?>>Benyt en bekræftelseskode som genereres af en authenticator-app</option>
				<option value="4" <?php if($configuration_deleteConfirmationIdidentities == 4){echo 'selected';} ?>>Benyt en bekræftelseskode som sendes til brugeren via sms</option>
				<option value="5" <?php if($configuration_deleteConfirmationIdidentities == 5){echo 'selected';} ?>>Benyt en bekræftelseskode som vises på skærmen</option>
				<option value="6" <?php if($configuration_deleteConfirmationIdidentities == 6){echo 'selected';} ?>>Benyt en fælles bekræftelseskode for alle brugere</option>
				<option value="7" <?php if($configuration_deleteConfirmationIdidentities == 7){echo 'selected';} ?>>Benyt en personlig bekræftelseskode for den enkelte bruger</option>
			</select><label for="inputDeleteConfirmationIdidentities">Bekræftelse ved sletning</label><br>
			<input class="example" onclick="" type="button" value="Se eksempel">
		</div>
		
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Gem sikkerhedsindstillinger">
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