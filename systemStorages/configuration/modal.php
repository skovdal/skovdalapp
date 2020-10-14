<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

$configuration_encryptionSystemStorages = getSystemConfigurations('encryptionSystemStorages');
if($configuration_encryptionSystemStorages == -1){
	$configuration_encryptionSystemStorages = 0;
}
$configuration_logSystemStorages = getSystemConfigurations('logSystemStorages');
if($configuration_logSystemStorages == -1){
	$configuration_logSystemStorages = 1;
}
$configuration_deleteConfirmationSystemStorages = getSystemConfigurations('deleteConfirmationSystemStorages');
if($configuration_deleteConfirmationSystemStorages == -1){
	$configuration_deleteConfirmationSystemStorages = 1;
}

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if($validateFlag == 200){
?>
	<h1>Sikkerhedsindstillinger for systembrugere</h1>
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
	<form action="/systemStorages/configuration/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<div>
			Det er muligt at kryptere alle opbevarede data om systembrugere.<br>
			<br>
			Complian anbefaler kraftigt, at du inden en eventuel aktivering sætter dig ind i følgerne af at gøre brug af funktionen.<br>
			<br>
			<a href="https://www.complian.com.complian.dev/support/da-DK/" target="_blank">Klik her for yderligere information om funktionen</a><br>
			<br>
			<select id="inputEncryptionSystemStorages" name="encryptionSystemStorages" autofocus required>
				<option value="1" <?php if($configuration_encryptionSystemStorages == 1){echo 'selected';} ?>>Krypter opbevarede data om systembrugere</option>
				<option value="0" <?php if($configuration_encryptionSystemStorages == 0){echo 'selected';} ?>>Krypter ikke opbevarede data om systembrugere</option>
			</select><label for="inputEncryptionSystemStorages">Kryptering ved opbevaring</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<select id="inputLogSystemStorages" name="logSystemStorages" autofocus required>
				<option value="1" <?php if($configuration_logSystemStorages == 1){echo 'selected';} ?>>Log hændelser om systembrugere</option>
				<option value="0" <?php if($configuration_logSystemStorages == 0){echo 'selected';} ?>>Log ikke hændelser om systembrugere</option>
			</select><label for="inputLogSystemStorages">Logning af hændelser</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<select id="inputDeleteConfirmationSystemStorages" name="deleteConfirmationSystemStorages" autofocus required>
				<option value="9" <?php if($configuration_deleteConfirmationSystemStorages == 9){echo 'selected';} ?>>Benyt Complian-appen til bekræftelse fra en anden systembruger</option>
				<option value="2" <?php if($configuration_deleteConfirmationSystemStorages == 2){echo 'selected';} ?>>Benyt brugerens adgangskode til bekræftelse</option>
				<option value="1" <?php if($configuration_deleteConfirmationSystemStorages == 1){echo 'selected';} ?>>Benyt tryk på knap til bekræftelse</option>
				<option value="3" <?php if($configuration_deleteConfirmationSystemStorages == 3){echo 'selected';} ?>>Benyt en bekræftelseskode som findes på et fysisk nøglekort</option>
				<option value="8" <?php if($configuration_deleteConfirmationSystemStorages == 8){echo 'selected';} ?>>Benyt en bekræftelseskode som genereres af en authenticator-app</option>
				<option value="4" <?php if($configuration_deleteConfirmationSystemStorages == 4){echo 'selected';} ?>>Benyt en bekræftelseskode som sendes til brugeren via sms</option>
				<option value="5" <?php if($configuration_deleteConfirmationSystemStorages == 5){echo 'selected';} ?>>Benyt en bekræftelseskode som vises på skærmen</option>
				<option value="6" <?php if($configuration_deleteConfirmationSystemStorages == 6){echo 'selected';} ?>>Benyt en fælles bekræftelseskode for alle brugere</option>
				<option value="7" <?php if($configuration_deleteConfirmationSystemStorages == 7){echo 'selected';} ?>>Benyt en personlig bekræftelseskode for den enkelte bruger</option>
			</select><label for="inputDeleteConfirmationSystemStorages">Bekræftelse ved sletning</label><br>
			<input class="example" onclick="" type="button" value="Se eksempel">
		</div>
		
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Gem sikkerhedsindstillinger">
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