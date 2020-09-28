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

if(isset($_POST['columnsBlockSignIn']) === false){
	$columnsBlockSignIn = 0;
}
else{
	$columnsBlockSignIn = 1;
}

if(isset($_POST['columnsUserMustChangePasswordAtNextSignIn']) === false){
	$columnsUserMustChangePasswordAtNextSignIn = 0;
}
else{
	$columnsUserMustChangePasswordAtNextSignIn = 1;
}

if(isset($_POST['columnsForceUseOfMultifactorAuthentication']) === false){
	$columnsForceUseOfMultifactorAuthentication = 0;
}
else{
	$columnsForceUseOfMultifactorAuthentication = 1;
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
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsSystemUsers_shortcutsNew'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsSystemUsers_shortcutsUpdate'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsSystemUsers_shortcutsExport'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsSystemUsers_shortcutsTags'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsSystemUsers_shortcutsDelete'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemUsers_columnsName'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemUsers_columnsSecurityClearance'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemUsers_columnsBlockSignIn'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemUsers_columnsForceUseOfMultifactorAuthentication'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemUsers_columnsEntityType'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemUsers_columnsEntityName'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemUsers_columnsEntityName2'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemUsers_columnsEntityPhone'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemUsers_columnsEntityEmail'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsSystemUsers_columnsTags'
			OR
			`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'orderBySystemUsers_orderBy'
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
		'shortcutsSystemUsers_shortcutsNew'
	)
	");
	$stmt->bind_param('ii', $shortcutsNew, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsSystemUsers_shortcutsNew' . '_' . $systemUsers_id] = $shortcutsNew;
	
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
		'shortcutsSystemUsers_shortcutsUpdate'
	)
	");
	$stmt->bind_param('ii', $shortcutsUpdate, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsSystemUsers_shortcutsUpdate' . '_' . $systemUsers_id] = $shortcutsUpdate;
			
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
		'shortcutsSystemUsers_shortcutsExport'
	)
	");
	$stmt->bind_param('ii', $shortcutsExport, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsSystemUsers_shortcutsExport' . '_' . $systemUsers_id] = $shortcutsExport;
		
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
		'shortcutsSystemUsers_shortcutsTags'
	)
	");
	$stmt->bind_param('ii', $shortcutsTags, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsSystemUsers_shortcutsTags' . '_' . $systemUsers_id] = $shortcutsTags;
		
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
		'shortcutsSystemUsers_shortcutsDelete'
	)
	");
	$stmt->bind_param('ii', $shortcutsDelete, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsSystemUsers_shortcutsDelete' . '_' . $systemUsers_id] = $shortcutsDelete;
		
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
		'columnsSystemUsers_columnsName'
	)
	");
	$stmt->bind_param('ii', $columnsName, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemUsers_columnsName' . '_' . $systemUsers_id] = $columnsName;
		
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
		'columnsSystemUsers_columnsSecurityClearance'
	)
	");
	$stmt->bind_param('ii', $columnsSecurityClearance, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemUsers_columnsSecurityClearance' . '_' . $systemUsers_id] = $columnsSecurityClearance;
		
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
		'columnsSystemUsers_columnsBlockSignIn'
	)
	");
	$stmt->bind_param('ii', $columnsBlockSignIn, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemUsers_columnsBlockSignIn' . '_' . $systemUsers_id] = $columnsBlockSignIn;
		
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
		'columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn'
	)
	");
	$stmt->bind_param('ii', $columnsUserMustChangePasswordAtNextSignIn, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemUsers_columnsUserMustChangePasswordAtNextSignIn' . '_' . $systemUsers_id] = $columnsUserMustChangePasswordAtNextSignIn;
		
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
		'columnsSystemUsers_columnsForceUseOfMultifactorAuthentication'
	)
	");
	$stmt->bind_param('ii', $columnsForceUseOfMultifactorAuthentication, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemUsers_columnsForceUseOfMultifactorAuthentication' . '_' . $systemUsers_id] = $columnsForceUseOfMultifactorAuthentication;
		
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
		'columnsSystemUsers_columnsEntityType'
	)
	");
	$stmt->bind_param('ii', $columnsEntityType, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemUsers_columnsEntityType' . '_' . $systemUsers_id] = $columnsEntityType;
		
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
		'columnsSystemUsers_columnsEntityName'
	)
	");
	$stmt->bind_param('ii', $columnsEntityName, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemUsers_columnsEntityName' . '_' . $systemUsers_id] = $columnsEntityName;
		
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
		'columnsSystemUsers_columnsEntityName2'
	)
	");
	$stmt->bind_param('ii', $columnsEntityName2, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemUsers_columnsEntityName2' . '_' . $systemUsers_id] = $columnsEntityName2;
		
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
		'columnsSystemUsers_columnsEntityPhone'
	)
	");
	$stmt->bind_param('ii', $columnsEntityPhone, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemUsers_columnsEntityPhone' . '_' . $systemUsers_id] = $columnsEntityPhone;
		
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
		'columnsSystemUsers_columnsEntityEmail'
	)
	");
	$stmt->bind_param('ii', $columnsEntityEmail, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemUsers_columnsEntityEmail' . '_' . $systemUsers_id] = $columnsEntityEmail;
		
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
		'columnsSystemUsers_columnsTags'
	)
	");
	$stmt->bind_param('ii', $columnsTags, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsSystemUsers_columnsEntityTags' . '_' . $systemUsers_id] = $columnsTags;
		
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
		'orderBySystemUsers_orderBy'
	)
	");
	$stmt->bind_param('si', $orderBy, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'orderBySystemUsers_orderBy' . '_' . $systemUsers_id] = $orderBy;
	?>
	<script>
		parent.datatableUpdate('', 'datatable1');
		
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
		if($columnsBlockSignIn == 1){
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
		if($columnsUserMustChangePasswordAtNextSignIn == 1){
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
		if($columnsForceUseOfMultifactorAuthentication == 1){
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
		parent.toastr('success', 'Præferencer for systembrugere', 'Præferencerne blev gemt.', 0, true, '');
	</script>
	<?php
	if(getSystemConfigurations('logSystemUsers') == 1 || getSystemConfigurations('logSystemUsers') == -1){
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
	if(getSystemConfigurations('logSystemUsers') == 1 || getSystemConfigurations('logSystemUsers') == -1){
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