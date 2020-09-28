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

if(isset($_POST['columnsType']) === false){
	$columnsType = 0;
}
else{
	$columnsType = 1;
}

if(isset($_POST['columnsName']) === false){
	$columnsName = 0;
}
else{
	$columnsName = 1;
}

if(isset($_POST['columnsSize']) === false){
	$columnsSize = 0;
}
else{
	$columnsSize = 1;
}

if(isset($_POST['columnsLastModified']) === false){
	$columnsLastModified = 0;
}
else{
	$columnsLastModified = 1;
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

$systemUsers_id = $_SESSION['systemUsers_id'];

if($validateFlag == 200){
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	DELETE FROM
	`s0`.`systemUsersSystemPreferences`
	WHERE
	`s0`.`systemUsersSystemPreferences`.`systemUsers_id` = ?
	AND
	(
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsFiles_shortcutsNew'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsFiles_shortcutsUpdate'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsFiles_shortcutsExport'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsFiles_shortcutsTags'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsFiles_shortcutsDelete'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsFiles_columnsType'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsFiles_columnsName'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsFiles_columnsSize'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsFiles_columnsLastModified'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsFiles_columnsTags'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'orderByFiles_orderBy'
	)
	");
	$stmt->bind_param('i', $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`systemUsers_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'shortcutsFiles_shortcutsNew'
	)
	");
	$stmt->bind_param('ii', $shortcutsNew, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsFiles_shortcutsNew' . '_' . $systemUsers_id] = $shortcutsNew;
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`systemUsers_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'shortcutsFiles_shortcutsUpdate'
	)
	");
	$stmt->bind_param('ii', $shortcutsUpdate, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsFiles_shortcutsUpdate' . '_' . $systemUsers_id] = $shortcutsUpdate;
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`systemUsers_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'shortcutsFiles_shortcutsExport'
	)
	");
	$stmt->bind_param('ii', $shortcutsExport, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsFiles_shortcutsExport' . '_' . $systemUsers_id] = $shortcutsExport;
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`systemUsers_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'shortcutsFiles_shortcutsTags'
	)
	");
	$stmt->bind_param('ii', $shortcutsTags, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsFiles_shortcutsTags' . '_' . $systemUsers_id] = $shortcutsTags;
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`systemUsers_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'shortcutsFiles_shortcutsDelete'
	)
	");
	$stmt->bind_param('ii', $shortcutsDelete, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsFiles_shortcutsDelete' . '_' . $systemUsers_id] = $shortcutsDelete;
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`systemUsers_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'columnsFiles_columnsType'
	)
	");
	$stmt->bind_param('ii', $columnsType, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsFiles_columnsType' . '_' . $systemUsers_id] = $columnsType;
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`systemUsers_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'columnsFiles_columnsName'
	)
	");
	$stmt->bind_param('ii', $columnsName, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsFiles_columnsName' . '_' . $systemUsers_id] = $columnsName;
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`systemUsers_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'columnsFiles_columnsSize'
	)
	");
	$stmt->bind_param('ii', $columnsSize, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsFiles_columnsSize' . '_' . $systemUsers_id] = $columnsSize;
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`systemUsers_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'columnsFiles_columnsLastModified'
	)
	");
	$stmt->bind_param('ii', $columnsLastModified, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsFiles_columnsLastModified' . '_' . $systemUsers_id] = $columnsLastModified;
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`systemUsers_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'columnsFiles_columnsTags'
	)
	");
	$stmt->bind_param('ii', $columnsTags, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsFiles_columnsTags' . '_' . $systemUsers_id] = $columnsTags;
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
	INSERT INTO
	`s0`.`systemUsersSystemPreferences`
	(
		`s0`.`systemUsersSystemPreferences`.`value`,
		`s0`.`systemUsersSystemPreferences`.`systemUsers_id`,
		`s0`.`systemUsersSystemPreferences`.`systemPreference`
	)
	VALUES
	(
		?,
		?,
		'orderByFiles_orderBy'
	)
	");
	$stmt->bind_param('si', $orderBy, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'orderByFiles_orderBy' . '_' . $systemUsers_id] = $orderBy;
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
		if($columnsType == 1){
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
		if($columnsName == 1){
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
		if($columnsSize == 1){
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[3].style.display = 'table-cell';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[3].style.display = 'table-cell';
		<?php
		}
		else{
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[3].style.display = 'none';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[3].style.display = 'none';
		<?php
		}
		?>
		
		<?php
		if($columnsLastModified == 1){
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[4].style.display = 'table-cell';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[4].style.display = 'table-cell';
		<?php
		}
		else{
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[4].style.display = 'none';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[4].style.display = 'none';
		<?php
		}
		?>
		
		<?php
		if($columnsTags == 1){
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[5].style.display = 'table-cell';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[5].style.display = 'table-cell';
		<?php
		}
		else{
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[5].style.display = 'none';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[5].style.display = 'none';
		<?php
		}
		?>
		
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();
		parent.toastr('success', 'Præferencer for filer', 'Præferencerne blev gemt.', 0, true, '');
	</script>
	<?php
	if(getSystemConfigurations('logFiles') == 1 || getSystemConfigurations('logFiles') == -1){
		$type = 'edit';
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
	if(getSystemConfigurations('logFiles') == 1 || getSystemConfigurations('logFiles') == -1){
		$type = 'edit';
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