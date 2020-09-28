<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if(isset($_POST['shortcutsNew']) === false){
	$shortcutsNew = 0;
}
else{
	$shortcutsNew = 1;
}

if(isset($_POST['shortcutsUpdate']) === false){
	$shortcutsUpdate = 0;
}
else{
	$shortcutsUpdate = 1;
}

if(isset($_POST['shortcutsExport']) === false){
	$shortcutsExport = 0;
}
else{
	$shortcutsExport = 1;
}

if(isset($_POST['shortcutsTags']) === false){
	$shortcutsTags = 0;
}
else{
	$shortcutsTags = 1;
}

if(isset($_POST['shortcutsDelete']) === false){
	$shortcutsDelete = 0;
}
else{
	$shortcutsDelete = 1;
}

if(isset($_POST['columnsName']) === false){
	$columnsName = 0;
}
else{
	$columnsName = 1;
}

if(isset($_POST['columnsSecurityClearance']) === false){
	$columnsSecurityClearance = 0;
}
else{
	$columnsSecurityClearance = 1;
}

if(isset($_POST['columnsEntityType']) === false){
	$columnsEntityType = 0;
}
else{
	$columnsEntityType = 1;
}

if(isset($_POST['columnsEntityName']) === false){
	$columnsEntityName = 0;
}
else{
	$columnsEntityName = 1;
}

if(isset($_POST['columnsEntityName2']) === false){
	$columnsEntityName2 = 0;
}
else{
	$columnsEntityName2 = 1;
}

if(isset($_POST['columnsEntityPhone']) === false){
	$columnsEntityPhone = 0;
}
else{
	$columnsEntityPhone = 1;
}

if(isset($_POST['columnsEntityEmail']) === false){
	$columnsEntityEmail = 0;
}
else{
	$columnsEntityEmail = 1;
}

if(isset($_POST['columnsTags']) === false){
	$columnsTags = 0;
}
else{
	$columnsTags = 1;
}

if(isset($_POST['orderBy']) === false){
	$validateFlag = 400;
}
else{
	$orderBy = $_POST['orderBy'];
}

$processingActivities_id = $_SESSION['processingActivities_id'];

if($validateFlag == 200){
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
		DELETE FROM
			`s0`.`systemUsersSystemPreferences`
		WHERE
			`s0`.`systemUsersSystemPreferences`.`processingActivities_id` = ?
			AND
			(
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsProcessingActivities_shortcutsNew'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsProcessingActivities_shortcutsUpdate'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsProcessingActivities_shortcutsExport'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsProcessingActivities_shortcutsTags'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsProcessingActivities_shortcutsDelete'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsProcessingActivities_columnsName'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsProcessingActivities_columnsSecurityClearance'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsProcessingActivities_columnsEntityType'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsProcessingActivities_columnsEntityName'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsProcessingActivities_columnsEntityName2'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsProcessingActivities_columnsEntityPhone'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsProcessingActivities_columnsEntityEmail'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsProcessingActivities_columnsTags'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'orderByProcessingActivities_orderBy'
			)
	");
	$stmt->bind_param('i', $processingActivities_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`processingActivities_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'shortcutsProcessingActivities_shortcutsNew'
	)
	");
	$stmt->bind_param('ii', $shortcutsNew, $processingActivities_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsProcessingActivities_shortcutsNew' . '_' . $processingActivities_id] = $shortcutsNew;
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`processingActivities_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'shortcutsProcessingActivities_shortcutsUpdate'
	)
	");
	$stmt->bind_param('ii', $shortcutsUpdate, $processingActivities_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsProcessingActivities_shortcutsUpdate' . '_' . $processingActivities_id] = $shortcutsUpdate;
			
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`processingActivities_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'shortcutsProcessingActivities_shortcutsExport'
	)
	");
	$stmt->bind_param('ii', $shortcutsExport, $processingActivities_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsProcessingActivities_shortcutsExport' . '_' . $processingActivities_id] = $shortcutsExport;
		
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`processingActivities_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'shortcutsProcessingActivities_shortcutsTags'
	)
	");
	$stmt->bind_param('ii', $shortcutsTags, $processingActivities_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsProcessingActivities_shortcutsTags' . '_' . $processingActivities_id] = $shortcutsTags;
		
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`processingActivities_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'shortcutsProcessingActivities_shortcutsDelete'
	)
	");
	$stmt->bind_param('ii', $shortcutsDelete, $processingActivities_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsProcessingActivities_shortcutsDelete' . '_' . $processingActivities_id] = $shortcutsDelete;
		
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`processingActivities_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'columnsProcessingActivities_columnsName'
	)
	");
	$stmt->bind_param('ii', $columnsName, $processingActivities_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsProcessingActivities_columnsName' . '_' . $processingActivities_id] = $columnsName;
		
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`processingActivities_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'columnsProcessingActivities_columnsSecurityClearance'
	)
	");
	$stmt->bind_param('ii', $columnsSecurityClearance, $processingActivities_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsProcessingActivities_columnsSecurityClearance' . '_' . $processingActivities_id] = $columnsSecurityClearance;
		
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`processingActivities_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'columnsProcessingActivities_columnsEntityType'
	)
	");
	$stmt->bind_param('ii', $columnsEntityType, $processingActivities_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsProcessingActivities_columnsEntityType' . '_' . $processingActivities_id] = $columnsEntityType;
		
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`processingActivities_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'columnsProcessingActivities_columnsEntityName'
	)
	");
	$stmt->bind_param('ii', $columnsEntityName, $processingActivities_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsProcessingActivities_columnsEntityName' . '_' . $processingActivities_id] = $columnsEntityName;
		
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`processingActivities_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'columnsProcessingActivities_columnsEntityName2'
	)
	");
	$stmt->bind_param('ii', $columnsEntityName2, $processingActivities_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsProcessingActivities_columnsEntityName2' . '_' . $processingActivities_id] = $columnsEntityName2;
		
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`processingActivities_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'columnsProcessingActivities_columnsEntityPhone'
	)
	");
	$stmt->bind_param('ii', $columnsEntityPhone, $processingActivities_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsProcessingActivities_columnsEntityPhone' . '_' . $processingActivities_id] = $columnsEntityPhone;
		
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`processingActivities_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'columnsProcessingActivities_columnsEntityEmail'
	)
	");
	$stmt->bind_param('ii', $columnsEntityEmail, $processingActivities_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsProcessingActivities_columnsEntityEmail' . '_' . $processingActivities_id] = $columnsEntityEmail;
		
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`processingActivities_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'columnsProcessingActivities_columnsTags'
	)
	");
	$stmt->bind_param('ii', $columnsTags, $processingActivities_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsProcessingActivities_columnsEntityTags' . '_' . $processingActivities_id] = $columnsTags;
		
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`processingActivities_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'orderByProcessingActivities_orderBy'
	)
	");
	$stmt->bind_param('si', $orderBy, $processingActivities_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'orderByProcessingActivities_orderBy' . '_' . $processingActivities_id] = $orderBy;
	?>
	<script>
		parent.datatableUpdate('', 'datatable1', 0);
		
		<?php
		if($shortcutsDelete == 1){
		?>
			parent.document.querySelectorAll('main > div.main div.datatable > div.action-btn.circle.delete')[0].style.display = 'inline-block';
		<?php
		}
		else{
		?>
			parent.document.querySelectorAll('main > div.main div.datatable > div.action-btn.circle.delete')[0].style.display = 'none';
		<?php
		}
		?>
		
		<?php
		if($shortcutsTags == 1){
		?>
			parent.document.querySelectorAll('main > div.main div.datatable > div.action-btn.circle.tags')[0].style.display = 'inline-block';
		<?php
		}
		else{
		?>
			parent.document.querySelectorAll('main > div.main div.datatable > div.action-btn.circle.tags')[0].style.display = 'none';
		<?php
		}
		?>
		
		<?php
		if($shortcutsExport == 1){
		?>
			parent.document.querySelectorAll('main > div.main div.datatable > div.action-btn.circle.export')[0].style.display = 'inline-block';
		<?php
		}
		else{
		?>
			parent.document.querySelectorAll('main > div.main div.datatable > div.action-btn.circle.export')[0].style.display = 'none';
		<?php
		}
		?>
		
		<?php
		if($shortcutsUpdate == 1){
		?>
			parent.document.querySelectorAll('main > div.main div.datatable > div.action-btn.circle.update')[0].style.display = 'inline-block';
		<?php
		}
		else{
		?>
			parent.document.querySelectorAll('main > div.main div.datatable > div.action-btn.circle.update')[0].style.display = 'none';
		<?php
		}
		?>
		
		<?php
		if($shortcutsNew == 1){
		?>
			parent.document.querySelectorAll('main > div.main div.datatable > div.action-btn.circle.add')[0].style.display = 'inline-block';
		<?php
		}
		else{
		?>
			parent.document.querySelectorAll('main > div.main div.datatable > div.action-btn.circle.add')[0].style.display = 'none';
		<?php
		}
		?>
		
		<?php
		if($columnsName == 1){
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[1].style.display = 'table-cell';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[1].style.display = 'table-cell';
		<?php
		}
		else{
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[1].style.display = 'none';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[1].style.display = 'none';
		<?php
		}
		?>
		
		<?php
		if($columnsSecurityClearance == 1){
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[2].style.display = 'table-cell';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[2].style.display = 'table-cell';
		<?php
		}
		else{
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[2].style.display = 'none';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[2].style.display = 'none';
		<?php
		}
		?>
		
		<?php
		if($columnsEntityType == 1){
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[6].style.display = 'table-cell';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[6].style.display = 'table-cell';
		<?php
		}
		else{
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[6].style.display = 'none';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[6].style.display = 'none';
		<?php
		}
		?>
		
		<?php
		if($columnsEntityName == 1){
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[7].style.display = 'table-cell';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[7].style.display = 'table-cell';
		<?php
		}
		else{
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[7].style.display = 'none';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[7].style.display = 'none';
		<?php
		}
		?>
		
		<?php
		if($columnsEntityName2 == 1){
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[8].style.display = 'table-cell';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[8].style.display = 'table-cell';
		<?php
		}
		else{
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[8].style.display = 'none';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[8].style.display = 'none';
		<?php
		}
		?>
		
		<?php
		if($columnsEntityPhone == 1){
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[9].style.display = 'table-cell';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[9].style.display = 'table-cell';
		<?php
		}
		else{
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[9].style.display = 'none';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[9].style.display = 'none';
		<?php
		}
		?>
		
		<?php
		if($columnsEntityEmail == 1){
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[10].style.display = 'table-cell';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[10].style.display = 'table-cell';
		<?php
		}
		else{
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[10].style.display = 'none';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[10].style.display = 'none';
		<?php
		}
		?>
		
		<?php
		if($columnsTags == 1){
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[11].style.display = 'table-cell';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[11].style.display = 'table-cell';
		<?php
		}
		else{
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[11].style.display = 'none';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[11].style.display = 'none';
		<?php
		}
		?>
		
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();
		parent.toastr('success', 'Præferencer for behandlingsaktiviteter', 'Præferencerne blev gemt.', 0, true, '');
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