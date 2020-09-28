<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
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

if(isset($_POST['columnsType']) === false){
	$columnsType = 0;
}
else{
	$columnsType = 1;
}

if(isset($_POST['columnsIpAddress']) === false){
	$columnsIpAddress = 0;
}
else{
	$columnsIpAddress = 1;
}

if(isset($_POST['columnsStartTime']) === false){
	$columnsStartTime = 0;
}
else{
	$columnsStartTime = 1;
}

if(isset($_POST['columnsEndTime']) === false){
	$columnsEndTime = 0;
}
else{
	$columnsEndTime = 1;
}

if(isset($_POST['columnsSystemUsers_name']) === false){
	$columnsSystemUsers_name = 0;
}
else{
	$columnsSystemUsers_name = 1;
}

if(isset($_POST['columnsFinished']) === false){
	$columnsFinished = 0;
}
else{
	$columnsFinished = 1;
}

if(isset($_POST['columnsHost']) === false){
	$columnsHost = 0;
}
else{
	$columnsHost = 1;
}

if(isset($_POST['columnsHttpVersion']) === false){
	$columnsHttpVersion = 0;
}
else{
	$columnsHttpVersion = 1;
}

if(isset($_POST['columnsInstanceId']) === false){
	$columnsInstanceId = 0;
}
else{
	$columnsInstanceId = 1;
}

if(isset($_POST['columnsMethod']) === false){
	$columnsMethod = 0;
}
else{
	$columnsMethod = 1;
}

if(isset($_POST['columnsStatus']) === false){
	$columnsStatus = 0;
}
else{
	$columnsStatus = 1;
}

if(isset($_POST['columnsUserAgent']) === false){
	$columnsUserAgent = 0;
}
else{
	$columnsUserAgent = 1;
}

if(isset($_POST['columnsVersion']) === false){
	$columnsVersion = 0;
}
else{
	$columnsVersion = 1;
}

if(isset($_POST['columnsHttpsEnabled']) === false){
	$columnsHttpsEnabled = 0;
}
else{
	$columnsHttpsEnabled = 1;
}

if(isset($_POST['columnsFileName']) === false){
	$columnsFileName = 0;
}
else{
	$columnsFileName = 1;
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
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsSystemEvents_shortcutsUpdate'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsSystemEvents_shortcutsExport'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsSystemEvents_shortcutsTags'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemEvents_columnsType'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemEvents_columnsIpAddress'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemEvents_columnsStartTime'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemEvents_columnsEndTime'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemEvents_columnsSystemUsers_name'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemEvents_columnsHttpVersion'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemEvents_columnsInstanceId'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemEvents_columnsMethod'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemEvents_columnsStatus'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemEvents_columnsUserAgent'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemEvents_columnsVersion'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemEvents_columnsHttpsEnabled'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemEvents_columnsFileName'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemEvents_columnsTags'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'orderBySystemEvents_orderBy'
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
		'shortcutsSystemEvents_shortcutsUpdate'
	)
	");
	$stmt->bind_param('ii', $shortcutsUpdate, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsSystemEvents_shortcutsUpdate' . '_' . $systemUsers_id] = $shortcutsUpdate;
	
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
		'shortcutsSystemEvents_shortcutsExport'
	)
	");
	$stmt->bind_param('ii', $shortcutsExport, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsSystemEvents_shortcutsExport' . '_' . $systemUsers_id] = $shortcutsExport;
	
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
		'shortcutsSystemEvents_shortcutsTags'
	)
	");
	$stmt->bind_param('ii', $shortcutsTags, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsSystemEvents_shortcutsTags' . '_' . $systemUsers_id] = $shortcutsTags;
	
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
		'columnsSystemEvents_columnsType'
	)
	");
	$stmt->bind_param('ii', $columnsType, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemEvents_columnsType' . '_' . $systemUsers_id] = $columnsType;
	
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
		'columnsSystemEvents_columnsSystemUsers_name'
	)
	");
	$stmt->bind_param('ii', $columnsSystemUsers_name, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemEvents_columnsSystemUsers_name' . '_' . $systemUsers_id] = $columnsSystemUsers_name;
	
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
		'columnsSystemEvents_columnsIpAddress'
	)
	");
	$stmt->bind_param('ii', $columnsIpAddress, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemEvents_columnsIpAddress' . '_' . $systemUsers_id] = $columnsIpAddress;
	
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
		'columnsSystemEvents_columnsStartTime'
	)
	");
	$stmt->bind_param('ii', $columnsStartTime, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemEvents_columnsStartTime' . '_' . $systemUsers_id] = $columnsStartTime;
	
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
		'columnsSystemEvents_columnsEndTime'
	)
	");
	$stmt->bind_param('ii', $columnsEndTime, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemEvents_columnsEndTime' . '_' . $systemUsers_id] = $columnsEndTime;
	
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
		'columnsSystemEvents_columnsFinished'
	)
	");
	$stmt->bind_param('ii', $columnsFinished, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemEvents_columnsFinished' . '_' . $systemUsers_id] = $columnsFinished;
	
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
		'columnsSystemEvents_columnsHost'
	)
	");
	$stmt->bind_param('ii', $columnsHost, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemEvents_columnsHost' . '_' . $systemUsers_id] = $columnsHost;
	
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
		'columnsSystemEvents_columnsHttpVersion'
	)
	");
	$stmt->bind_param('ii', $columnsHttpVersion, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemEvents_columnsHttpVersion' . '_' . $systemUsers_id] = $columnsHttpVersion;
	
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
		'columnsSystemEvents_columnsInstanceId'
	)
	");
	$stmt->bind_param('ii', $columnsInstanceId, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemEvents_columnsInstanceId' . '_' . $systemUsers_id] = $columnsInstanceId;
	
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
		'columnsSystemEvents_columnsMethod'
	)
	");
	$stmt->bind_param('ii', $columnsMethod, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemEvents_columnsMethod' . '_' . $systemUsers_id] = $columnsMethod;
	
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
		'columnsSystemEvents_columnsStatus'
	)
	");
	$stmt->bind_param('ii', $columnsStatus, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemEvents_columnsStatus' . '_' . $systemUsers_id] = $columnsStatus;
	
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
		'columnsSystemEvents_columnsUserAgent'
	)
	");
	$stmt->bind_param('ii', $columnsUserAgent, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemEvents_columnsUserAgent' . '_' . $systemUsers_id] = $columnsUserAgent;
	
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
		'columnsSystemEvents_columnsVersion'
	)
	");
	$stmt->bind_param('ii', $columnsVersion, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemEvents_columnsVersion' . '_' . $systemUsers_id] = $columnsVersion;
	
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
		'columnsSystemEvents_columnsHttpsEnabled'
	)
	");
	$stmt->bind_param('ii', $columnsHttpsEnabled, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemEvents_columnsHttpsEnabled' . '_' . $systemUsers_id] = $columnsHttpsEnabled;
	
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
		'columnsSystemEvents_columnsFileName'
	)
	");
	$stmt->bind_param('ii', $columnsFileName, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemEvents_columnsFileName' . '_' . $systemUsers_id] = $columnsFileName;
	
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
		'columnsSystemEvents_columnsTags'
	)
	");
	$stmt->bind_param('ii', $columnsTags, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemEvents_columnsTags' . '_' . $systemUsers_id] = $columnsTags;
	
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
		'orderBySystemEvents_orderBy'
	)
	");
	$stmt->bind_param('si', $orderBy, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'orderBySystemEvents_orderBy' . '_' . $systemUsers_id] = $orderBy;
	?>
	<script>
		parent.datatableUpdate('', 'datatable1');
		
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
		if($columnsTitle == 1){
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
		if($columnsMsg == 1){
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
		if($columnsSystemUsers_name == 1){
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
		if($columnsDate == 1){
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
		
		<?php
		if($columnsIpAddress == 1){
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
		if($columnsTags == 1){
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
		
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();
		parent.toastr('success', 'Præferencer for systemhændelser', 'Præferencerne blev gemt.', 0, true, '');
	</script>
	<?php
	if(getSystemConfigurations('logSystemEvents') == 1 || getSystemConfigurations('logSystemEvents') == -1){
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
	if(getSystemConfigurations('logSystemEvents') == 1 || getSystemConfigurations('logSystemEvents') == -1){
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