<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

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

if(isset($_POST['systemStorages_id']) === false){
	$validateFlag = 400;
}
else{
	$systemStorages_id = $_POST['systemStorages_id'];
}

if($validateFlag == 200){
?>
	<h1>Slet markerede systemlagre</h1>
	<form action="/systemStorages/deleteMultiple/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<input name="systemStorages_id" type="hidden" value="<?php echo purify($systemStorages_id); ?>">
		<div>
			Bekræft venligst at du ønsker at slette <?php echo substr_count(purify($systemStorages_id),',') +1; ?> <?php if(substr_count(purify($systemStorages_id),',') == 0){echo 'systemlager';}else{echo 'systemlagre';} ?>.<br>
			<?php
			if($configuration_deleteConfirmationSystemStorages == 2){
			?>
				<br>
				Indtast din adgangskode for at bekræfte <?php if(substr_count(purify($systemStorages_id),',') == 0){echo 'sletningen';}else{echo 'sletningerne';} ?>.<br>
				<br>
				<input id="inputPassword" name="password" placeholder="Din adgangskode" type="password" required autofocus><label for="inputPassword">Adgangskode</label><br>
			<?php
			}
			else if($configuration_deleteConfirmationSystemStorages == 3){
			?>
				<br>
				Indtast bekræftelseskoden til nøgle <strong>789</strong> på dit nøglekort for at bekræfte <?php if(substr_count(purify($systemStorages_id),',') == 0){echo 'sletningen';}else{echo 'sletningerne';} ?>.<br>
				<br>
				<input id="inputConfirmationCode" name="confirmationCode" placeholder="123456" type="number" required autofocus><label for="inputConfirmationCode">Bekræftelseskode</label><br>
			<?php
			}
			else if($configuration_deleteConfirmationSystemStorages == 4){
			?>
				<br>
				Indtast bekræftelseskoden som er sendt til dig via sms for at bekræfte <?php if(substr_count(purify($systemStorages_id),',') == 0){echo 'sletningen';}else{echo 'sletningerne';} ?>.<br>
				<br>
				<input id="inputConfirmationCode" name="confirmationCode" placeholder="123456" type="number" required autofocus><label for="inputConfirmationCode">Bekræftelseskode</label><br>
			<?php
			}
			else if($configuration_deleteConfirmationSystemStorages == 5){
			?>
				<br>
				Indtast bekræftelseskoden <strong><?php echo purify($confirmationCode); ?></strong> for at bekræfte <?php if(substr_count(purify($systemStorages_id),',') == 0){echo 'sletningen';}else{echo 'sletningerne';} ?>.<br>
				<br>
				<input id="inputConfirmationCode" name="confirmationCode" placeholder="<?php echo purify($confirmationCode); ?>" type="number" required autofocus><label for="inputConfirmationCode">Bekræftelseskode</label><br>
			<?php
			}
			else if($configuration_deleteConfirmationSystemStorages == 6){
			?>
				<br>
				Indtast den fælles bekræftelseskode for at bekræfte <?php if(substr_count(purify($systemStorages_id),',') == 0){echo 'sletningen';}else{echo 'sletningerne';} ?>.<br>
				<br>
				<input id="inputConfirmationCode" name="confirmationCode" placeholder="123456" type="number" required autofocus><label for="inputConfirmationCode">Bekræftelseskode</label><br>
			<?php
			}
			else if($configuration_deleteConfirmationSystemStorages == 7){
			?>
				<br>
				Indtast din personlige bekræftelseskode for at bekræfte <?php if(substr_count(purify($systemStorages_id),',') == 0){echo 'sletningen';}else{echo 'sletningerne';} ?>.<br>
				<br>
				<input id="inputConfirmationCode" name="confirmationCode" placeholder="123456" type="number" required autofocus><label for="inputConfirmationCode">Bekræftelseskode</label><br>
			<?php
			}
			else if($configuration_deleteConfirmationSystemStorages == 8){
			?>
				<br>
				Indtast bekræftelseskoden som er genereret af din authenticator-app for at bekræfte <?php if(substr_count(purify($systemStorages_id),',') == 0){echo 'sletningen';}else{echo 'sletningerne';} ?>.<br>
				<br>
				<input id="inputConfirmationCode" name="confirmationCode" placeholder="123456" type="number" required autofocus><label for="inputConfirmationCode">Bekræftelseskode</label><br>
			<?php
			}
			else if($configuration_deleteConfirmationSystemStorages == 9){
			?>
				Bekræft <?php if(substr_count(purify($systemStorages_id),',') == 0){echo 'sletningen';}else{echo 'sletningerne';} ?> fra en anden systembruger via Complian-appen.<br>
				<br>
				Status: Afventer bekræftelse
			<?php
			}
			?>
		</div>
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input class="delete" type="submit" value="Slet <?php if(substr_count(purify($systemStorages_id),',') == 0){echo 'systemlager';}else{echo 'systemlagre';} ?>">
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