<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if(isset($_POST['encryptionProcessingActivities']) === false){
	$validateFlag = 400;
}
else{
	$encryptionProcessingActivities = $_POST['encryptionProcessingActivities'];
}

if(isset($_POST['logProcessingActivities']) === false){
	$validateFlag = 400;
}
else{
	$logProcessingActivities = $_POST['logProcessingActivities'];
}

if(isset($_POST['deleteConfirmationProcessingActivities']) === false){
	$validateFlag = 400;
}
else{
	$deleteConfirmationProcessingActivities = $_POST['deleteConfirmationProcessingActivities'];
}

if($validateFlag == 200){
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
		DELETE FROM
			`s0`.`systemConfigurations`
		WHERE
			`s0`.`systemConfigurations`.`systemConfiguration` = 'encryptionProcessingActivities'
			OR
			`s0`.`systemConfigurations`.`systemConfiguration` = 'logProcessingActivities'
			OR
			`s0`.`systemConfigurations`.`systemConfiguration` = 'deleteConfirmationProcessingActivities'
	");
	$stmt->bind_param('i', $processingActivities_id);
	$stmt->execute();
	setTableVersion('systemConfigurations');
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemConfigurations`
	(
		`s0`.`systemConfigurations`.`value`,
		`s0`.`systemConfigurations`.`systemConfiguration`
	)
	VALUES
	(
		?,
		'encryptionProcessingActivities'
	)
	");
	$stmt->bind_param('i', $encryptionProcessingActivities);
	$stmt->execute();
	setTableVersion('systemConfigurations');
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemConfigurations`
	(
		`s0`.`systemConfigurations`.`value`,
		`s0`.`systemConfigurations`.`systemConfiguration`
	)
	VALUES
	(
		?,
		'logProcessingActivities'
	)
	");
	$stmt->bind_param('i', $logProcessingActivities);
	$stmt->execute();
	setTableVersion('systemConfigurations');
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemConfigurations`
	(
		`s0`.`systemConfigurations`.`value`,
		`s0`.`systemConfigurations`.`systemConfiguration`
	)
	VALUES
	(
		?,
		'deleteConfirmationProcessingActivities'
	)
	");
	$stmt->bind_param('i', $deleteConfirmationProcessingActivities);
	$stmt->execute();
	setTableVersion('systemConfigurations');
	?>
	<script>
		parent.datatableUpdate('', 'datatable1');
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();
		parent.toastr('success', 'Sikkerhedsindstillinger for behandlingsaktiviteter', 'Sikkerhedsindstillingerne blev gemt.', 0, true, '');
	</script>
	<?php
	if(getSystemConfigurations('logProcessingActivities') == 1 || getSystemConfigurations('logProcessingActivities') == -1){
		$type = 'edit';
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
?>
	<script>
		for(var i = 0; i < parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> input[type="text"], #modal-<?php echo purify($modalId); ?> input[type="tel"], #modal-<?php echo purify($modalId); ?> input[type="email"], #modal-<?php echo purify($modalId); ?> input[type="number"]').length; i++){
			parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> input[type="text"], #modal-<?php echo purify($modalId); ?> input[type="tel"], #modal-<?php echo purify($modalId); ?> input[type="email"], #modal-<?php echo purify($modalId); ?> input[type="number"]')[i].readOnly = false;
		}
		
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> input[type="submit"]')[0].disabled = false;
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> input[type="submit"]')[0].value = 'Gem';
		parent.toastr('danger', 'Der er opstået en fejl!', 'Der er desværre opstået en fejl i systemet, hvilket vi beklager.<br><br>Fejlen er rapporteret og vil blive adresseret i løbet af kort tid.<br><br>Klik her for at følge status...', 0, true, 'https://errors.complian.app.complian.dev?1234-ABCD-5678-EFGH');
	</script>
	<?php
	if(getSystemConfigurations('logProcessingActivities') == 1 || getSystemConfigurations('logProcessingActivities') == -1){
		$type = 'edit';
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