<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

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
	if(decodeId($systemStorages_id) == -1){
		$validateFlag = 400;
	}
	else{
		$systemStorages_id = decodeId($systemStorages_id);
	}
}

if(isset($con) === false){$con = dbConnection();}
$stmt = $con->stmt_init();
$stmt->prepare("
	SELECT
		`c0`.`systemStorages`.`name` AS `systemStorages_name`,
		`c0`.`systemStorages`.`type` AS `systemStorages_type`,
		`c0`.`systemStorages`.`indelible` AS `systemStorages_indelible`,
		`c0`.`systemStorages`.`storageSize` AS `systemStorages_storageSize`,
		`c0`.`systemStorages`.`ftp_connect_host` AS `systemStorages_ftp_connect_host`,
		`c0`.`systemStorages`.`ftp_connect_port` AS `systemStorages_ftp_connect_port`,
		`c0`.`systemStorages`.`ftp_connect_timeout` AS `systemStorages_ftp_connect_timeout`,
		`c0`.`systemStorages`.`ftp_login_username` AS `systemStorages_ftp_login_username`,
		`c0`.`systemStorages`.`ftp_login_password` AS `systemStorages_ftp_login_password`,
		`c0`.`systemStorages`.`ftp_pasv` AS `systemStorages_ftp_pasv`,
		`c0`.`systemStorages`.`ftp_ssl_connect_timeout` AS `systemStorages_ftp_ssl_connect_timeout`,
		`c0`.`systemStorages`.`ftp_ssl_connect_port` AS `systemStorages_ftp_ssl_connect_port`,
		`c0`.`systemStorages`.`ftp_put_remote_path` AS `systemStorages_ftp_put_remote_path`,
		`c0`.`systemStorages`.`mysql_host` AS `systemStorages_mysql_host`,
		`c0`.`systemStorages`.`mysql_username` AS `systemStorages_mysql_username`,
		`c0`.`systemStorages`.`mysql_password` AS `systemStorages_mysql_password`,
		`c0`.`systemStorages`.`mysql_dbname` AS `systemStorages_mysql_dbname`,
		`c0`.`systemStorages`.`mysql_port` AS `systemStorages_mysql_port`,
		`c0`.`systemStorages`.`mysql_socket` AS `systemStorages_mysql_socket`
	FROM
		`c0`.`systemStorages`
	WHERE
		`c0`.`systemStorages`.`id` = ?
	LIMIT 1
");
$stmt->bind_param('i', $systemStorages_id);
$stmt->execute();
$result = $stmt->get_result();

if(mysqli_num_rows($result) == 0){
	$validateFlag = 400;
}
else{
	while($row = mysqli_fetch_assoc($result)){
		$systemStorages_name = $row['systemStorages_name'];
		$systemStorages_type = $row['systemStorages_type'];
		$systemStorages_indelible = $row['systemStorages_indelible'];
		$systemStorages_storageSize = $row['systemStorages_storageSize'];
		$systemStorages_ftp_connect_host = $row['systemStorages_ftp_connect_host'];
		$systemStorages_ftp_connect_port = $row['systemStorages_ftp_connect_port'];
		$systemStorages_ftp_connect_timeout = $row['systemStorages_ftp_connect_timeout'];
		$systemStorages_ftp_login_username = $row['systemStorages_ftp_login_username'];
		$systemStorages_ftp_login_password = $row['systemStorages_ftp_login_password'];
		$systemStorages_ftp_ssl_connect_port = $row['systemStorages_ftp_ssl_connect_port'];
		$systemStorages_ftp_ssl_connect_timeout = $row['systemStorages_ftp_ssl_connect_timeout'];
		$systemStorages_ftp_pasv = $row['systemStorages_ftp_pasv'];
		$systemStorages_ftp_put_remote_path = $row['systemStorages_ftp_put_remote_path'];
		$systemStorages_mysql_host = $row['systemStorages_mysql_host'];
		$systemStorages_mysql_username = $row['systemStorages_mysql_username'];
		$systemStorages_mysql_password = $row['systemStorages_mysql_password'];
		$systemStorages_mysql_dbname = $row['systemStorages_mysql_dbname'];
		$systemStorages_mysql_port = $row['systemStorages_mysql_port'];
		$systemStorages_mysql_socket = $row['systemStorages_mysql_socket'];
	}
}
$result->close();

if($validateFlag == 200){
?>
	<input class="modalScript" type="hidden" value="
		(function(){
			checkConnection(
				'<?php echo encodeId(purify($systemStorages_id)); ?>',
				0,
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form div.pulseContainer')[0],
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputType')[0],
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputName')[0],
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLHost')[0],
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLUsername')[0],
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLPassword')[0],
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLDbName')[0],
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLPort')[0],
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLSocket')[0],
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPHost')[0],
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPort')[0],
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPTimeout')[0],
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPRemotePath')[0],
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPSSLPort')[0],
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPSSLTimeout')[0],
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPassiveMode')[0],
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPUsername')[0],
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPassword')[0]
			);
		})();
	">
	<input class="modalScript" type="hidden" value="
		(function(){
			if(document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputType')[0].options[document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputType')[0].selectedIndex].value == 'FTP'){
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLUsername')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLUsername + label')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLUsername + label + br')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLPassword')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLPassword + label')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLPassword + label + br')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPUsername')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPUsername + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPUsername + label + br')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPassword')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPassword + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPassword + label + br')[0].style.display = 'inline';
				
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLDbName')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLDbName + label')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLDbName + label + br')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLHost')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLHost + label')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLHost + label + br')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLPort')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLPort + label')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLPort + label + br')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLSocket')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLSocket + label')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLSocket + label + br')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPHost')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPHost + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPHost + label + br')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPort')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPort + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPort + label + br')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPTimeout')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPTimeout + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPTimeout + label + br')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPRemotePath')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPRemotePath + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPRemotePath + label + br')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPSSLPort')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPSSLPort + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPSSLPort + label + br')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPSSLTimeout')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPSSLTimeout + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPSSLTimeout + label + br')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPassiveMode')[0].parentElement.style.display = 'inline-block';
			}
			else if(document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputType')[0].options[document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputType')[0].selectedIndex].value == 'FTPS'){
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLUsername')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLUsername + label')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLUsername + label + br')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLPassword')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLPassword + label')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLPassword + label + br')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPUsername')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPUsername + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPUsername + label + br')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPassword')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPassword + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPassword + label + br')[0].style.display = 'inline';
				
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLDbName')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLDbName + label')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLDbName + label + br')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLHost')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLHost + label')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLHost + label + br')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLPort')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLPort + label')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLPort + label + br')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLSocket')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLSocket + label')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLSocket + label + br')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPHost')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPHost + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPHost + label + br')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPort')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPort + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPort + label + br')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPTimeout')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPTimeout + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPTimeout + label + br')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPRemotePath')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPRemotePath + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPRemotePath + label + br')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPSSLPort')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPSSLPort + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPSSLPort + label + br')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPSSLTimeout')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPSSLTimeout + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPSSLTimeout + label + br')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPassiveMode')[0].parentElement.style.display = 'none';
			}
			else if(document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputType')[0].options[document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputType')[0].selectedIndex].value == 'MySQL 8.0'){
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLUsername')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLUsername + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLUsername + label + br')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLPassword')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLPassword + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLPassword + label + br')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPUsername')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPUsername + label')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPUsername + label + br')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPassword')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPassword + label')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPassword + label + br')[0].style.display = 'none';
				
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLDbName')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLDbName + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLDbName + label + br')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLHost')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLHost + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLHost + label + br')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLPort')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLPort + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLPort + label + br')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLSocket')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLSocket + label')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputMySQLSocket + label + br')[0].style.display = 'inline';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPHost')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPHost + label')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPHost + label + br')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPort')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPort + label')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPort + label + br')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPTimeout')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPTimeout + label')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPTimeout + label + br')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPRemotePath')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPRemotePath + label')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPRemotePath + label + br')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPSSLPort')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPSSLPort + label')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPSSLPort + label + br')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPSSLTimeout')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPSSLTimeout + label')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPSSLTimeout + label + br')[0].style.display = 'none';
				document.querySelectorAll('#modal-<?php echo $modalId; ?> form #inputFTPPassiveMode')[0].parentElement.style.display = 'none';
			}
		})();
	">
	<h1><?php echo purify($systemStorages_name); ?></h1>
	<ul>
		<li class="active" onclick="modalTab('<?php echo purify($modalId); ?>', 1);">
			Generelt
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 2);">
			Autentificering
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 3);">
			Forbindelse
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 4);">
			Logbog
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 5);">
			Mærker
		</li>
	</ul>
	<form action="/systemStorages/edit/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<input name="systemStorages_id" type="hidden" value="<?php echo encodeId(purify($systemStorages_id)); ?>">
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input id="inputName" name="name" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="Jens Nielsen" type="text" value="<?php echo purify($systemStorages_name); ?>" required autofocus><label for="inputName">Navn</label><br>
			<select id="inputType" name="type" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value); eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[1].value);" required>
				<optgroup label="Database">
<!-- 					<option value="MariaDB" <?php if($systemStorages_type == 'MariaDB'){echo 'selected';}?>>MariaDB</option> -->
<!-- 					<option value="MySQL 5.6" <?php if($systemStorages_type == 'MySQL 5.6'){echo 'selected';}?>>MySQL 5.6</option> -->
<!-- 					<option value="MySQL 5.7" <?php if($systemStorages_type == 'MySQL 5.7'){echo 'selected';}?>>MySQL 5.7</option> -->
					<option value="MySQL 8.0" <?php if($systemStorages_type == 'MariaDB'){echo 'selected';}?>>MySQL 8.0</option>
<!-- 					<option value="Oracle" <?php if($systemStorages_type == 'Oracle'){echo 'selected';}?>>Oracle</option> -->
<!-- 					<option value="PostgreSQL 9.6" <?php if($systemStorages_type == 'PostgreSQL 9.6'){echo 'selected';}?>>PostgreSQL 9.6</option> -->
<!-- 					<option value="PostgreSQL 10" <?php if($systemStorages_type == 'PostgreSQL 10'){echo 'selected';}?>>PostgreSQL 10</option> -->
<!-- 					<option value="PostgreSQL 11" <?php if($systemStorages_type == 'PostgreSQL 11'){echo 'selected';}?>>PostgreSQL 11</option> -->
<!-- 					<option value="PostgreSQL 12" <?php if($systemStorages_type == 'PostgreSQL 12'){echo 'selected';}?>>PostgreSQL 12</option> -->
<!-- 					<option value="SQL 2017" <?php if($systemStorages_type == 'SQL 2017'){echo 'selected';}?>>SQL 2017</option> -->
				</optgroup>
				<option disabled></option>
				<optgroup label="Fillager">
<!-- 					<option value="Amazon S3" <?php if($systemStorages_type == 'Amazon S3'){echo 'selected';}?>>Amazon S3</option> -->
<!-- 					<option value="Box" <?php if($systemStorages_type == 'Box'){echo 'selected';}?>>Box</option> -->
<!-- 					<option value="Dropbox" <?php if($systemStorages_type == 'Dropbox'){echo 'selected';}?>>Dropbox</option> -->
					<option value="FTP" <?php if($systemStorages_type == 'FTP'){echo 'selected';}?>>FTP</option>
					<option value="FTPS" <?php if($systemStorages_type == 'FTPS'){echo 'selected';}?>>FTPS</option>
<!-- 					<option value="Google Drive" <?php if($systemStorages_type == 'Google Drives'){echo 'selected';}?>>Google Drives</option> -->
<!-- 					<option value="Microsoft Azure" <?php if($systemStorages_type == 'Microsoft Azure'){echo 'selected';}?>>Microsoft Azure</option> -->
<!-- 					<option value="Microsoft OneDrive" <?php if($systemStorages_type == 'Microsoft OneDrive'){echo 'selected';}?>>Microsoft OneDrive</option> -->
<!-- 					<option value="Microsoft OneDrive for Business" <?php if($systemStorages_type == 'Microsoft OneDrive for Business'){echo 'selected';}?>>Microsoft OneDrive for Business</option> -->
<!-- 					<option value="SFTP" <?php if($systemStorages_type == 'SFTP'){echo 'selected';}?>>SFTP</option> -->
<!-- 					<option value="WebDav" <?php if($systemStorages_type == 'WebDav'){echo 'selected';}?>>WebDav</option> -->
				</optgroup>
			</select><label for="inputType">Type</label><br>
			<input id="inputStorageSize" name="storageSize" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="1000000" type="text" value="<?php echo purify(storageSize($systemStorages_storageSize, 0)); ?>" required><label for="inputStorageSize">Lagerstørrelse</label><br>
		</div>
		
		<div>
			<input id="inputMySQLUsername" name="mysqlUsername" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="pocahontas" type="text" value="<?php echo purify($systemStorages_mysql_username); ?>" required autofocus><label for="inputMySQLUsername">MySQL-brugernavn</label><br>
			<input id="inputMySQLPassword" name="mysqlPassword" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="Adgangskode" type="password" value="<?php echo purify($systemStorages_mysql_password); ?>" required><label for="inputMySQLPassword">MySQL-adgangskode</label><br>
			<input id="inputFTPUsername" name="ftpUsername" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="pocahontas" type="text" value="<?php echo purify($systemStorages_mysql_username); ?>" required autofocus><label for="inputFTPUsername">FTP-brugernavn</label><br>
			<input id="inputFTPPassword" name="ftpPassword" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="Adgangskode" type="password" value="<?php echo purify($systemStorages_mysql_password); ?>" required><label for="inputFTPPassword">FTP-adgangskode</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input id="inputMySQLDbName" name="mysqlDbName" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="Abcd" type="text" value="<?php echo purify($systemStorages_mysql_dbname); ?>" required><label for="inputMySQLDbName">MySQL-database</label><br>
			<input id="inputMySQLHost" name="mysqlHost" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="mysql.skovdal.com eller 123.123.123.123" type="text" value="<?php echo purify($systemStorages_mysql_host); ?>" required><label for="inputMySQLHost">MySQL-værtsadresse</label><br>
			<input id="inputMySQLPort" name="mysqlPort" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="3306" type="text" value="<?php echo purify($systemStorages_mysql_port); ?>"><label for="inputMySQLPort">MySQL-port</label><br>
			<input id="inputMySQLSocket" name="mysqlSocket" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="/var/run/mysqld/mysqld.sock" type="text" value="<?php echo purify($systemStorages_mysql_socket); ?>"><label for="inputMySQLSocket">MySQL-socket</label><br>
			<input id="inputFTPHost" name="ftpHost" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="10s" type="text" value="<?php echo purify($systemStorages_ftp_connect_host); ?>" required><label for="inputFTPHost">FTP-værtsadresse</label><br>
			<input id="inputFTPPort" name="ftpPort" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="10s" type="text" value="<?php echo purify($systemStorages_ftp_connect_port); ?>" required><label for="inputFTPPort">FTP-port</label><br>
			<input id="inputFTPTimeout" name="ftpTimeout" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="10s" type="text" value="<?php echo purify($systemStorages_ftp_connect_timeout); ?>" required><label for="inputFTPTimeout">FTP-timeout</label><br>
			<input id="inputFTPRemotePath" name="ftpRemotePath" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="10s" type="text" value="<?php echo purify($systemStorages_ftp_put_remote_path); ?>" required><label for="inputFTPRemotePath">FTP remote path</label><br>
			<input id="inputFTPSSLPort" name="ftpSSLPort" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="10s" type="text" value="<?php echo purify($systemStorages_ftp_ssl_connect_port); ?>" required><label for="inputFTPSSLPort">FTP-SSL-port</label><br>
			<input id="inputFTPSSLTimeout" name="FTPSSLTimeout" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="10s" type="text" value="<?php echo purify($systemStorages_ftp_ssl_connect_timeout); ?>" required><label for="inputFTPSSLTimeout">FTP-SSL-timeout</label><br>
			<div class="checkbox <?php if($systemStorages_ftp_pasv == 1){echo 'checked';}else{echo 'unchecked';}?>" onclick="modalCheckbox(this);" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);"><input id="inputFTPPassiveMode" name="ftpPassiveMode" type="checkbox" value="1" <?php if($systemStorages_ftp_pasv == 1){echo 'checked';}?>><label for="inputFTPPassiveMode">Passiv</label><br></div>
		</div>
		
		<div class="contentTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="contentContainer">
				<div class="noContent" style="background-image:url('/images/svgImage.php?id=%2Fimages%2Ffontawesome-pro-5.9.0-web%2Fsvgs%2Flight%2Fbars.svg&fill=rgba%28135%2C140%2C145%2C1%29');">
					<br><br><br><br><br><br><br><br><br>Der er ikke registreret nogen hændelser
				</div>
			</div>
		</div>
		
		<div class="tagTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="tagContainer">
				<?php
				if(isset($con) === false){$con = dbConnection();}
				$stmt = $con->stmt_init();
				$stmt->prepare("
					SELECT
						`s0`.`tagsReferences`.`id` AS `tagsReferences_id`,
						`c0`.`tags`.`name` AS `tags_name`,
						`c0`.`tags`.`borderColor` AS `tags_borderColor`,
						`c0`.`tags`.`backgroundColor` AS `tags_backgroundColor`,
						`c0`.`tags`.`fontColor` AS `tags_fontColor`
					FROM
						`s0`.`tagsReferences`
					INNER JOIN
						`c0`.`tags`
					ON
						`s0`.`tagsReferences`.`tags_id` = `c0`.`tags`.`id`
					WHERE
						`s0`.`tagsReferences`.`deleteFlag` IS NULL
						AND
						`s0`.`tagsReferences`.`tempFlag` IS NULL
						AND
						`s0`.`tagsReferences`.`legacyFlag` IS NULL
						AND
						`s0`.`tagsReferences`.`systemStorages_id` = ?
					ORDER BY
						`c0`.`tags`.`name` ASC
				");
				$stmt->bind_param('i', $systemStorages_id);
				$stmt->execute();
				$result = $stmt->get_result();
				
				if(mysqli_num_rows($result) == 0){
				}
				else{
					while($row = mysqli_fetch_assoc($result)){
						echo '<div class="tag" onclick="modalDeleteTag(this, \'' . purify($row['tags_name']) . '\', \'' . purify($modalId) . '\');" style="background-color:' . purify($row['tags_backgroundColor']) . '; background-image:url(\'/images/svgImage.php?id=' . urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/times-circle.svg') . '&fill=' . urlencode(purify($row['tags_fontColor'])) . '\'); border:1px solid ' . purify($row['tags_borderColor']) . '; color:' . purify($row['tags_fontColor']) . ';">' . purify($row['tags_name']) . '</div>';
					}
				}
				$result->close();
							?>
			</div>
			<input class="addTag" onclick="modal(0, 'basic', '/systemStorages/edit/tags/add/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>&systemStorages_id=<?php echo encodeId(purify($systemStorages_id)); ?>', true, 1);" type="button" value="Tilføj mærke" autofocus>
			
			<?php
			if(isset($con) === false){$con = dbConnection();}
			$stmt = $con->stmt_init();
			$stmt->prepare("
				SELECT
					`s0`.`tagsReferences`.`id` AS `tagsReferences_id`,
					`c0`.`tags`.`name` AS `tags_name`,
					`c0`.`tags`.`borderColor` AS `tags_borderColor`,
					`c0`.`tags`.`backgroundColor` AS `tags_backgroundColor`,
					`c0`.`tags`.`fontColor` AS `tags_fontColor`
				FROM
					`s0`.`tagsReferences`
				INNER JOIN
					`c0`.`tags`
				ON
					`s0`.`tagsReferences`.`tags_id` = `c0`.`tags`.`id`
				WHERE
					`s0`.`tagsReferences`.`deleteFlag` IS NULL
					AND
					`s0`.`tagsReferences`.`tempFlag` IS NULL
					AND
					`s0`.`tagsReferences`.`legacyFlag` IS NULL
					AND
					`s0`.`tagsReferences`.`systemStorages_id` = ?
				ORDER BY
					`c0`.`tags`.`name` ASC
			");
			$stmt->bind_param('i', $systemStorages_id);
			$stmt->execute();
			$result = $stmt->get_result();
			
			if(mysqli_num_rows($result) == 0){
			}
			else{
				while($row = mysqli_fetch_assoc($result)){
					echo '<input data-backgroundColor="' . purify($row['tags_backgroundColor']) . '" data-fontColor="' . purify($row['tags_fontColor']) . '" data-borderColor="' . purify($row['tags_borderColor']) . '" name="tag-name-' . encodeId(purify($row['tagsReferences_id'])) . '" type="hidden" value="' . purify($row['tags_name']) . '">';
					echo '<input data-backgroundColor="' . purify($row['tags_backgroundColor']) . '" data-fontColor="' . purify($row['tags_fontColor']) . '" data-borderColor="' . purify($row['tags_borderColor']) . '" name="tag-borderColor-' . encodeId(purify($row['tagsReferences_id'])) . '" type="hidden" value="' . purify($row['tags_borderColor']) . '">';
					echo '<input data-backgroundColor="' . purify($row['tags_backgroundColor']) . '" data-fontColor="' . purify($row['tags_fontColor']) . '" data-borderColor="' . purify($row['tags_borderColor']) . '" name="tag-backgroundColor-' . encodeId(purify($row['tagsReferences_id'])) . '" type="hidden" value="' . purify($row['tags_backgroundColor']) . '">';
					echo '<input data-backgroundColor="' . purify($row['tags_backgroundColor']) . '" data-fontColor="' . purify($row['tags_fontColor']) . '" data-borderColor="' . purify($row['tags_borderColor']) . '" name="tag-fontColor-' . encodeId(purify($row['tagsReferences_id'])) . '" type="hidden" value="' . purify($row['tags_fontColor']) . '">';
				}
			}
			$result->close();
			?>
		</div>
		
		<div class="buttons">
			<div class="pulseContainer"><div class="pulseCore danger"></div><div class="pulse danger"></div></div>
			<?php if($systemStorages_indelible === null){ ?><input class="delete" onclick="modal(0, 'basic', '/systemStorages/edit/delete/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>&systemStorages_id=<?php echo encodeId(purify($systemStorages_id)); ?>', true, 1);" type="button" value="Slet systemlager"><?php } ?><input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Gem systemlager">
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