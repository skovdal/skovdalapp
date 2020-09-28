<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

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

if(isset($_POST['identities_id']) === false){
	$validateFlag = 400;
}
else{
	$identities_id = $_POST['identities_id'];
	if(decodeId($identities_id) == -1){
		$validateFlag = 400;
	}
	else{
		$identities_id = decodeId($identities_id);
	}
}

if(isset($con) === false){$con = dbConnection();}
$stmt = $con->stmt_init();
$stmt->prepare("
	SELECT
		`c0`.`identities`.`name` AS `identities_name`
	FROM
		`c0`.`identities`
	WHERE
		`c0`.`identities`.`id` = ?
	LIMIT 1
");
$stmt->bind_param('i', $identities_id);
$stmt->execute();
$result = $stmt->get_result();

if(mysqli_num_rows($result) == 0){
	$validateFlag = 400;
}
else{
	while($row = mysqli_fetch_assoc($result)){
		$identities_name = $row['identities_name'];
	}
}
$result->close();

if($validateFlag == 200){
?>
	<h1>Slet identitet</h1>
	<form action="/identities/deleteSingle/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<input name="identities_id" type="hidden" value="<?php echo encodeId(purify($identities_id)); ?>">
		<div>
			Bekræft venligst at du ønsker at slette identiteten <strong><?php echo purify($identities_name); ?></strong>.<br>
			<?php
			if($configuration_deleteConfirmationIdidentities == 2){
			?>
				<br>
				Indtast din adgangskode for at bekræfte sletningen.<br>
				<br>
				<input id="inputPassword" name="password" placeholder="Din adgangskode" type="password" required autofocus><label for="inputPassword">Adgangskode</label><br>
			<?php
			}
			else if($configuration_deleteConfirmationIdidentities == 3){
			?>
				<br>
				Indtast bekræftelseskoden til nøgle <strong>789</strong> på dit nøglekort.<br>
				<br>
				<input id="inputConfirmationCode" name="confirmationCode" placeholder="123456" type="number" required autofocus><label for="inputConfirmationCode">Bekræftelseskode</label><br>
			<?php
			}
			else if($configuration_deleteConfirmationIdidentities == 4){
			?>
				<br>
				Indtast bekræftelseskoden som er sendt til dig via sms.<br>
				<br>
				<input id="inputConfirmationCode" name="confirmationCode" placeholder="123456" type="number" required autofocus><label for="inputConfirmationCode">Bekræftelseskode</label><br>
			<?php
			}
			else if($configuration_deleteConfirmationIdidentities == 5){
			?>
				<br>
				Indtast bekræftelseskoden <strong><?php echo purify($confirmationCode); ?></strong> for at bekræfte sletningen.<br>
				<br>
				<input id="inputConfirmationCode" name="confirmationCode" placeholder="<?php echo purify($confirmationCode); ?>" type="number" required autofocus><label for="inputConfirmationCode">Bekræftelseskode</label><br>
			<?php
			}
			else if($configuration_deleteConfirmationIdidentities == 6){
			?>
				<br>
				Indtast den fælles bekræftelseskode for at bekræfte sletningen.<br>
				<br>
				<input id="inputConfirmationCode" name="confirmationCode" placeholder="123456" type="number" required autofocus><label for="inputConfirmationCode">Bekræftelseskode</label><br>
			<?php
			}
			else if($configuration_deleteConfirmationIdidentities == 7){
			?>
				<br>
				Indtast din personlige bekræftelseskode for at bekræfte sletningen.<br>
				<br>
				<input id="inputConfirmationCode" name="confirmationCode" placeholder="123456" type="number" required autofocus><label for="inputConfirmationCode">Bekræftelseskode</label><br>
			<?php
			}
			else if($configuration_deleteConfirmationIdidentities == 8){
			?>
				<br>
				Indtast bekræftelseskoden som er genereret af din authenticator-app.<br>
				<br>
				<input id="inputConfirmationCode" name="confirmationCode" placeholder="123456" type="number" required autofocus><label for="inputConfirmationCode">Bekræftelseskode</label><br>
			<?php
			}
			else if($configuration_deleteConfirmationIdidentities == 9){
			?>
				Bekræft sletningen fra en anden identitet via Complian-appen.<br>
				<br>
				Status: Afventer bekræftelse
			<?php
			}
			?>
		</div>
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input class="delete" type="submit" value="Slet identitet" <?php if($configuration_deleteConfirmationIdidentities == 9){echo 'disabled';}?>>
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