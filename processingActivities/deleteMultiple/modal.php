<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

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

if(isset($_POST['processingActivities_id']) === false){
	$validateFlag = 400;
}
else{
	$processingActivities_id = $_POST['processingActivities_id'];
}

if($validateFlag == 200){
?>
	<h1>Slet markerede behandlingsaktiviteter</h1>
	<form action="/processingActivities/deleteMultiple/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<input name="processingActivities_id" type="hidden" value="<?php echo purify($processingActivities_id); ?>">
		<div>
			Bekræft venligst at du ønsker at slette <?php echo substr_count(purify($processingActivities_id),',') +1; ?> <?php if(substr_count(purify($processingActivities_id),',') == 0){echo 'behandlingsaktivitet';}else{echo 'behandlingsaktiviteter';} ?>.<br>
			<?php
			if($configuration_deleteConfirmationProcessingActivities == 2){
			?>
				<br>
				Indtast din adgangskode for at bekræfte <?php if(substr_count(purify($processingActivities_id),',') == 0){echo 'sletningen';}else{echo 'sletningerne';} ?>.<br>
				<br>
				<input id="inputPassword" name="password" placeholder="Din adgangskode" type="password" required autofocus><label for="inputPassword">Adgangskode</label><br>
			<?php
			}
			else if($configuration_deleteConfirmationProcessingActivities == 3){
			?>
				<br>
				Indtast bekræftelseskoden til nøgle <strong>789</strong> på dit nøglekort for at bekræfte <?php if(substr_count(purify($processingActivities_id),',') == 0){echo 'sletningen';}else{echo 'sletningerne';} ?>.<br>
				<br>
				<input id="inputConfirmationCode" name="confirmationCode" placeholder="123456" type="number" required autofocus><label for="inputConfirmationCode">Bekræftelseskode</label><br>
			<?php
			}
			else if($configuration_deleteConfirmationProcessingActivities == 4){
			?>
				<br>
				Indtast bekræftelseskoden som er sendt til dig via sms for at bekræfte <?php if(substr_count(purify($processingActivities_id),',') == 0){echo 'sletningen';}else{echo 'sletningerne';} ?>.<br>
				<br>
				<input id="inputConfirmationCode" name="confirmationCode" placeholder="123456" type="number" required autofocus><label for="inputConfirmationCode">Bekræftelseskode</label><br>
			<?php
			}
			else if($configuration_deleteConfirmationProcessingActivities == 5){
			?>
				<br>
				Indtast bekræftelseskoden <strong><?php echo purify($confirmationCode); ?></strong> for at bekræfte <?php if(substr_count(purify($processingActivities_id),',') == 0){echo 'sletningen';}else{echo 'sletningerne';} ?>.<br>
				<br>
				<input id="inputConfirmationCode" name="confirmationCode" placeholder="<?php echo purify($confirmationCode); ?>" type="number" required autofocus><label for="inputConfirmationCode">Bekræftelseskode</label><br>
			<?php
			}
			else if($configuration_deleteConfirmationProcessingActivities == 6){
			?>
				<br>
				Indtast den fælles bekræftelseskode for at bekræfte <?php if(substr_count(purify($processingActivities_id),',') == 0){echo 'sletningen';}else{echo 'sletningerne';} ?>.<br>
				<br>
				<input id="inputConfirmationCode" name="confirmationCode" placeholder="123456" type="number" required autofocus><label for="inputConfirmationCode">Bekræftelseskode</label><br>
			<?php
			}
			else if($configuration_deleteConfirmationProcessingActivities == 7){
			?>
				<br>
				Indtast din personlige bekræftelseskode for at bekræfte <?php if(substr_count(purify($processingActivities_id),',') == 0){echo 'sletningen';}else{echo 'sletningerne';} ?>.<br>
				<br>
				<input id="inputConfirmationCode" name="confirmationCode" placeholder="123456" type="number" required autofocus><label for="inputConfirmationCode">Bekræftelseskode</label><br>
			<?php
			}
			else if($configuration_deleteConfirmationProcessingActivities == 8){
			?>
				<br>
				Indtast bekræftelseskoden som er genereret af din authenticator-app for at bekræfte <?php if(substr_count(purify($processingActivities_id),',') == 0){echo 'sletningen';}else{echo 'sletningerne';} ?>.<br>
				<br>
				<input id="inputConfirmationCode" name="confirmationCode" placeholder="123456" type="number" required autofocus><label for="inputConfirmationCode">Bekræftelseskode</label><br>
			<?php
			}
			else if($configuration_deleteConfirmationProcessingActivities == 9){
			?>
				Bekræft <?php if(substr_count(purify($processingActivities_id),',') == 0){echo 'sletningen';}else{echo 'sletningerne';} ?> fra en anden behandlingsaktivitet via Complian-appen.<br>
				<br>
				Status: Afventer bekræftelse
			<?php
			}
			?>
		</div>
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input class="delete" type="submit" value="Slet <?php if(substr_count(purify($processingActivities_id),',') == 0){echo 'behandlingsaktivitet';}else{echo 'behandlingsaktiviteter';} ?>">
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