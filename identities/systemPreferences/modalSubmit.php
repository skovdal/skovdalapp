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

if(isset($_POST['columnsName2']) === false){
	$columnsName2 = 0;
}
else{
	$columnsName2 = 1;
}

if(isset($_POST['columnsCvrNumber']) === false){
	$columnsCvrNumber = 0;
}
else{
	$columnsCvrNumber = 1;
}

if(isset($_POST['columnsCprNumber']) === false){
	$columnsCprNumber = 0;
}
else{
	$columnsCprNumber = 1;
}

if(isset($_POST['columnsAddress']) === false){
	$columnsAddress = 0;
}
else{
	$columnsAddress = 1;
}

if(isset($_POST['columnsAddress2']) === false){
	$columnsAddress2 = 0;
}
else{
	$columnsAddress2 = 1;
}

if(isset($_POST['columnsZipCode']) === false){
	$columnsZipCode = 0;
}
else{
	$columnsZipCode = 1;
}

if(isset($_POST['columnsCity']) === false){
	$columnsCity = 0;
}
else{
	$columnsCity = 1;
}

if(isset($_POST['columnsCountry']) === false){
	$columnsCountry = 0;
}
else{
	$columnsCountry = 1;
}

if(isset($_POST['columnsPhone']) === false){
	$columnsPhone = 0;
}
else{
	$columnsPhone = 1;
}

if(isset($_POST['columnsPhone2']) === false){
	$columnsPhone2 = 0;
}
else{
	$columnsPhone2 = 1;
}

if(isset($_POST['columnsEmail']) === false){
	$columnsEmail = 0;
}
else{
	$columnsEmail = 1;
}

if(isset($_POST['columnsEmail2']) === false){
	$columnsEmail2 = 0;
}
else{
	$columnsEmail2 = 1;
}

if(isset($_POST['columnsTags']) === false){
	$columnsTags = 0;
}
else{
	$columnsTags = 1;
}

if(isset($_POST['copyPrefix']) === false){
	$validateFlag = 400;
}
else{
	$copyPrefix = $_POST['copyPrefix'];
}

if(isset($_POST['newEntityType']) === false){
	$validateFlag = 400;
}
else{
	$newEntityType = $_POST['newEntityType'];
}

if(isset($_POST['newEntityPreEnteredCvrNumber']) === false){
	$validateFlag = 400;
}
else{
	$newEntityPreEnteredCvrNumber = $_POST['newEntityPreEnteredCvrNumber'];
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
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsIdidentities_shortcutsNew'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsIdidentities_shortcutsUpdate'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsIdidentities_shortcutsExport'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsIdidentities_shortcutsTags'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'shortcutsIdidentities_shortcutsDelete'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsIdidentities_columnsType'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsIdidentities_columnsName'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsIdidentities_columnsName2'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsIdidentities_columnsCvrNumber'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsIdidentities_columnsCprNumber'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsIdidentities_columnsAddress'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsIdidentities_columnsAddress2'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsIdidentities_columnsZipCode'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsIdidentities_columnsCity'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsIdidentities_columnsCountry'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsIdidentities_columnsPhone'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsIdidentities_columnsPhone2'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsIdidentities_columnsEmail'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsIdidentities_columnsEmail2'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'columnsIdidentities_columnsTags'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'copyIdidentities_copyPrefix'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'newEntityIdidentities_newEntityType'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'newEntityIdidentities_newEntityPreEnteredCvrNumber'
		OR
		`s0`.`systemUsersSystemPreferences`.`systemPreference` = 'orderByIdidentities_orderBy'
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
		'shortcutsIdidentities_shortcutsNew'
	)
	");
	$stmt->bind_param('ii', $shortcutsNew, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsIdidentities_shortcutsNew' . '_' . $systemUsers_id] = $shortcutsNew;
	
	
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
		'shortcutsIdidentities_shortcutsUpdate'
	)
	");
	$stmt->bind_param('ii', $shortcutsUpdate, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsIdidentities_shortcutsUpdate' . '_' . $systemUsers_id] = $shortcutsUpdate;
	
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
		'shortcutsIdidentities_shortcutsExport'
	)
	");
	$stmt->bind_param('ii', $shortcutsExport, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsIdidentities_shortcutsExport' . '_' . $systemUsers_id] = $shortcutsExport;
	
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
		'shortcutsIdidentities_shortcutsTags'
	)
	");
	$stmt->bind_param('ii', $shortcutsTags, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsIdidentities_shortcutsTags' . '_' . $systemUsers_id] = $shortcutsTags;
	
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
		'shortcutsIdidentities_shortcutsDelete'
	)
	");
	$stmt->bind_param('ii', $shortcutsDelete, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'shortcutsIdidentities_shortcutsDelete' . '_' . $systemUsers_id] = $shortcutsDelete;
	
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
		'columnsIdidentities_columnsType'
	)
	");
	$stmt->bind_param('ii', $columnsType, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsIdidentities_columnsType' . '_' . $systemUsers_id] = $columnsType;
	
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
		'columnsIdidentities_columnsName'
	)
	");
	$stmt->bind_param('ii', $columnsName, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsIdidentities_columnsName' . '_' . $systemUsers_id] = $columnsName;
	
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
		'columnsIdidentities_columnsName2'
	)
	");
	$stmt->bind_param('ii', $columnsName2, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsIdidentities_columnsName2' . '_' . $systemUsers_id] = $columnsName2;
	
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
		'columnsIdidentities_columnsCvrNumber'
	)
	");
	$stmt->bind_param('ii', $columnsCvrNumber, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsIdidentities_columnsCvrNumber' . '_' . $systemUsers_id] = $columnsCvrNumber;
	
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
		'columnsIdidentities_columnsCprNumber'
	)
	");
	$stmt->bind_param('ii', $columnsCprNumber, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsIdidentities_columnsCprNumber' . '_' . $systemUsers_id] = $columnsCprNumber;
	
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
		'columnsIdidentities_columnsAddress'
	)
	");
	$stmt->bind_param('ii', $columnsAddress, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsIdidentities_columnsAddress' . '_' . $systemUsers_id] = $columnsAddress;
	
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
		'columnsIdidentities_columnsAddress2'
	)
	");
	$stmt->bind_param('ii', $columnsAddress2, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsIdidentities_columnsAddress2' . '_' . $systemUsers_id] = $columnsAddress2;
	
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
		'columnsIdidentities_columnsZipCode'
	)
	");
	$stmt->bind_param('ii', $columnsZipCode, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsIdidentities_columnsZipCode' . '_' . $systemUsers_id] = $columnsZipCode;
	
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
		'columnsIdidentities_columnsCity'
	)
	");
	$stmt->bind_param('ii', $columnsCity, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsIdidentities_columnsCity' . '_' . $systemUsers_id] = $columnsCity;
	
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
		'columnsIdidentities_columnsCountry'
	)
	");
	$stmt->bind_param('ii', $columnsCountry, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsIdidentities_columnsCountry' . '_' . $systemUsers_id] = $columnsCountry;
	
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
		'columnsIdidentities_columnsPhone'
	)
	");
	$stmt->bind_param('ii', $columnsPhone, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsIdidentities_columnsPhone' . '_' . $systemUsers_id] = $columnsPhone;
	
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
		'columnsIdidentities_columnsPhone2'
	)
	");
	$stmt->bind_param('ii', $columnsPhone2, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsIdidentities_columnsPhone2' . '_' . $systemUsers_id] = $columnsPhone2;
	
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
		'columnsIdidentities_columnsEmail'
	)
	");
	$stmt->bind_param('ii', $columnsEmail, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsIdidentities_columnsEmail' . '_' . $systemUsers_id] = $columnsEmail;
	
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
		'columnsIdidentities_columnsEmail2'
	)
	");
	$stmt->bind_param('ii', $columnsEmail2, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsIdidentities_columnsEmail2' . '_' . $systemUsers_id] = $columnsEmail2;
	
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
		'columnsIdidentities_columnsTags'
	)
	");
	$stmt->bind_param('ii', $columnsTags, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'columnsIdidentities_columnsTags' . '_' . $systemUsers_id] = $columnsTags;
	
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
		'copyIdidentities_copyPrefix'
	)
	");
	$stmt->bind_param('si', $copyPrefix, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'copyIdidentities_copyPrefix' . '_' . $systemUsers_id] = $copyPrefix;
	
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
		'newEntityIdidentities_newEntityType'
	)
	");
	$stmt->bind_param('si', $newEntityType, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'newEntityIdidentities_newEntityType' . '_' . $systemUsers_id] = $newEntityType;
	
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
		'newEntityIdidentities_newEntityPreEnteredCvrNumber'
	)
	");
	$stmt->bind_param('si', $newEntityPreEnteredCvrNumber, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'newEntityIdidentities_newEntityPreEnteredCvrNumber' . '_' . $systemUsers_id] = $newEntityPreEnteredCvrNumber;
	
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
		'orderByIdidentities_orderBy'
	)
	");
	$stmt->bind_param('si', $orderBy, $systemUsers_id);
	$stmt->execute();
	setTableVersion('systemUsersSystemPreferences');
	$_SESSION['systemUsersSystemPreferences_' . 'orderByIdidentities_orderBy' . '_' . $systemUsers_id] = $orderBy;
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
		if($columnsName2 == 1){
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
		if($columnsCvrNumber == 1){
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
		if($columnsCprNumber == 1){
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
		if($columnsAddress == 1){
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
		if($columnsAddress2 == 1){
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
		if($columnsZipCode == 1){
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
		if($columnsCity == 1){
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
		if($columnsCountry == 1){
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
		if($columnsPhone == 1){
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
		
		<?php
		if($columnsPhone2 == 1){
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[12].style.display = 'table-cell';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[12].style.display = 'table-cell';
		<?php
		}
		else{
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[12].style.display = 'none';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[12].style.display = 'none';
		<?php
		}
		?>
		
		<?php
		if($columnsEmail == 1){
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[13].style.display = 'table-cell';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[13].style.display = 'table-cell';
		<?php
		}
		else{
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[13].style.display = 'none';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[13].style.display = 'none';
		<?php
		}
		?>
		
		<?php
		if($columnsEmail2 == 1){
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[14].style.display = 'table-cell';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[14].style.display = 'table-cell';
		<?php
		}
		else{
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[14].style.display = 'none';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[14].style.display = 'none';
		<?php
		}
		?>
		
		<?php
		if($columnsTags == 1){
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[15].style.display = 'table-cell';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[15].style.display = 'table-cell';
		<?php
		}
		else{
		?>
			parent.document.querySelectorAll('main > div.main div.datatable table tr td')[15].style.display = 'none';
			parent.document.querySelectorAll('main > div.main div.datatable table tr th')[15].style.display = 'none';
		<?php
		}
		?>
		
		parent.document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();
		parent.toastr('success', 'Præferencer for identiteter', 'Præferencerne blev gemt.', 0, true, '');
	</script>
	<?php
	if(getSystemConfigurations('logIdidentities') == 1 || getSystemConfigurations('logIdidentities') == -1){
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
	if(getSystemConfigurations('logIdidentities') == 1 || getSystemConfigurations('logIdidentities') == -1){
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