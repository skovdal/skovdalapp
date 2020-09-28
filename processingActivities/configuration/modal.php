<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

$configuration_encryptionProcessingActivities = getSystemConfigurations('encryptionProcessingActivities');
if($configuration_encryptionProcessingActivities == -1){
	$configuration_encryptionProcessingActivities = 0;
}
$configuration_logProcessingActivities = getSystemConfigurations('logProcessingActivities');
if($configuration_logProcessingActivities == -1){
	$configuration_logProcessingActivities = 1;
}
$configuration_deleteConfirmationProcessingActivities = getSystemConfigurations('deleteConfirmationProcessingActivities');
if($configuration_deleteConfirmationProcessingActivities == -1){
	$configuration_deleteConfirmationProcessingActivities = 1;
}

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if($validateFlag == 200){
?>
	<h1>Sikkerhedsindstillinger for behandlingsaktiviteter</h1>
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
	<form action="/processingActivities/configuration/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<div>
			Det er muligt at kryptere alle opbevarede data om behandlingsaktiviteter.<br>
			<br>
			Complian anbefaler kraftigt, at du inden en eventuel aktivering sætter dig ind i følgerne af at gøre brug af funktionen.<br>
			<br>
			<a href="https://www.complian.com.complian.dev/support/da-DK/" target="_blank">Klik her for yderligere information om funktionen</a><br>
			<br>
			<select id="inputEncryptionProcessingActivities" name="encryptionProcessingActivities" autofocus required>
				<option value="1" <?php if($configuration_encryptionProcessingActivities == 1){echo 'selected';} ?>>Krypter opbevarede data om behandlingsaktiviteter</option>
				<option value="0" <?php if($configuration_encryptionProcessingActivities == 0){echo 'selected';} ?>>Krypter ikke opbevarede data om behandlingsaktiviteter</option>
			</select><label for="inputEncryptionProcessingActivities">Kryptering ved opbevaring</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<select id="inputLogProcessingActivities" name="logProcessingActivities" autofocus required>
				<option value="1" <?php if($configuration_logProcessingActivities == 1){echo 'selected';} ?>>Log hændelser om behandlingsaktiviteter</option>
				<option value="0" <?php if($configuration_logProcessingActivities == 0){echo 'selected';} ?>>Log ikke hændelser om behandlingsaktiviteter</option>
			</select><label for="inputLogProcessingActivities">Logning af hændelser</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<select id="inputDeleteConfirmationProcessingActivities" name="deleteConfirmationProcessingActivities" autofocus required>
				<option value="9" <?php if($configuration_deleteConfirmationProcessingActivities == 9){echo 'selected';} ?>>Benyt Complian-appen til bekræftelse fra en anden behandlingsaktivitet</option>
				<option value="2" <?php if($configuration_deleteConfirmationProcessingActivities == 2){echo 'selected';} ?>>Benyt brugerens adgangskode til bekræftelse</option>
				<option value="1" <?php if($configuration_deleteConfirmationProcessingActivities == 1){echo 'selected';} ?>>Benyt tryk på knap til bekræftelse</option>
				<option value="3" <?php if($configuration_deleteConfirmationProcessingActivities == 3){echo 'selected';} ?>>Benyt en bekræftelseskode som findes på et fysisk nøglekort</option>
				<option value="8" <?php if($configuration_deleteConfirmationProcessingActivities == 8){echo 'selected';} ?>>Benyt en bekræftelseskode som genereres af en authenticator-app</option>
				<option value="4" <?php if($configuration_deleteConfirmationProcessingActivities == 4){echo 'selected';} ?>>Benyt en bekræftelseskode som sendes til brugeren via sms</option>
				<option value="5" <?php if($configuration_deleteConfirmationProcessingActivities == 5){echo 'selected';} ?>>Benyt en bekræftelseskode som vises på skærmen</option>
				<option value="6" <?php if($configuration_deleteConfirmationProcessingActivities == 6){echo 'selected';} ?>>Benyt en fælles bekræftelseskode for alle brugere</option>
				<option value="7" <?php if($configuration_deleteConfirmationProcessingActivities == 7){echo 'selected';} ?>>Benyt en personlig bekræftelseskode for den enkelte bruger</option>
			</select><label for="inputDeleteConfirmationProcessingActivities">Bekræftelse ved sletning</label><br>
			<input class="example" onclick="" type="button" value="Se eksempel">
		</div>
		
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Gem sikkerhedsindstillinger">
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