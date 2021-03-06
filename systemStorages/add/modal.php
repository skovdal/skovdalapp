<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if($validateFlag == 200){
?>
	<input class="modalScript" type="hidden" value="
		(function(){
			checkConnection(
				0,
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
	<h1>Nyt systemlager</h1>
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
			Mærker
		</li>
	</ul>
	<form action="/systemStorages/add/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input id="inputName" name="name" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="Jens Nielsen" type="text" required autofocus><label for="inputName">Navn</label><br>
			<select id="inputType" name="type" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value); eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[1].value);" required>
				<optgroup label="Database">
<!-- 					<option value="MariaDB">MariaDB</option> -->
<!-- 					<option value="MySQL 5.6">MySQL 5.6</option> -->
<!-- 					<option value="MySQL 5.7">MySQL 5.7</option> -->
					<option value="MySQL 8.0">MySQL 8.0</option>
<!-- 					<option value="Oracle">Oracle</option> -->
<!-- 					<option value="PostgreSQL 9.6">PostgreSQL 9.6</option> -->
<!-- 					<option value="PostgreSQL 10">PostgreSQL 10</option> -->
<!-- 					<option value="PostgreSQL 11">PostgreSQL 11</option> -->
<!-- 					<option value="PostgreSQL 12">PostgreSQL 12</option> -->
<!-- 					<option value="SQL 2017">SQL 2017</option> -->
				</optgroup>
				<option disabled></option>
				<optgroup label="Fillager">
<!-- 					<option value="Amazon S3">Amazon S3</option> -->
<!-- 					<option value="Box">Box</option> -->
<!-- 					<option value="Dropbox">Dropbox</option> -->
					<option value="FTP">FTP</option>
					<option value="FTPS">FTPS</option>
<!-- 					<option value="Google Drive">Google Drives</option> -->
<!-- 					<option value="Microsoft Azure">Microsoft Azure</option> -->
<!-- 					<option value="Microsoft OneDrive">Microsoft OneDrive</option> -->
<!-- 					<option value="Microsoft OneDrive for Business">Microsoft OneDrive for Business</option> -->
<!-- 					<option value="SFTP">SFTP</option> -->
<!-- 					<option value="WebDav">WebDav</option> -->
				</optgroup>
			</select><label for="inputType">Type</label><br>
			<input id="inputStorageSize" name="storageSize" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="1000000" type="text" required><label for="inputStorageSize">Lagerstørrelse</label><br>
		</div>
		
		<div>
			<input id="inputMySQLUsername" name="mysqlUsername" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="pocahontas" type="text" required autofocus><label for="inputMySQLUsername">MySQL-brugernavn</label><br>
			<input id="inputMySQLPassword" name="mysqlPassword" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="Adgangskode" type="password" required><label for="inputMySQLPassword">MySQL-adgangskode</label><br>
			<input id="inputFTPUsername" name="ftpUsername" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="pocahontas" type="text" required autofocus><label for="inputFTPUsername">FTP-brugernavn</label><br>
			<input id="inputFTPPassword" name="ftpPassword" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="Adgangskode" type="password" required><label for="inputFTPPassword">FTP-adgangskode</label><br>
		</div>
		
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<input id="inputMySQLDbName" name="mysqlDbName" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="Abcd" type="text" required><label for="inputMySQLDbName">MySQL-database</label><br>
			<input id="inputMySQLHost" name="mysqlHost" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="mysql.skovdal.com eller 123.123.123.123" type="text" required><label for="inputMySQLHost">MySQL-værtsadresse</label><br>
			<input id="inputMySQLPort" name="mysqlPort" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="3306" type="text" value="3306"><label for="inputMySQLPort">MySQL-port</label><br>
			<input id="inputMySQLSocket" name="mysqlSocket" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="/var/run/mysqld/mysqld.sock" type="text"><label for="inputMySQLSocket">MySQL-socket</label><br>
			<input id="inputFTPHost" name="ftpHost" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="10s" type="text" required><label for="inputFTPHost">FTP-værtsadresse</label><br>
			<input id="inputFTPPort" name="ftpPort" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="10s" type="text" required><label for="inputFTPPort">FTP-port</label><br>
			<input id="inputFTPTimeout" name="ftpTimeout" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="10s" type="text" required><label for="inputFTPTimeout">FTP-timeout</label><br>
			<input id="inputFTPRemotePath" name="ftpRemotePath" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="10s" type="text" required><label for="inputFTPRemotePath">FTP remote path</label><br>
			<input id="inputFTPSSLPort" name="ftpSSLPort" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="10s" type="text" required><label for="inputFTPSSLPort">FTP-SSL-port</label><br>
			<input id="inputFTPSSLTimeout" name="FTPSSLTimeout" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);" pattern=".{3,}" placeholder="10s" type="text" required><label for="inputFTPSSLTimeout">FTP-SSL-timeout</label><br>
			<div class="checkbox <?php if($systemStorages_ftp_ssl_connect_port == 1){echo 'checked';}else{echo 'unchecked';}?>" onclick="modalCheckbox(this);" onchange="eval(document.querySelectorAll('#modal-<?php echo $modalId; ?> .modalScript')[0].value);"><input id="inputFTPPassiveMode" name="ftpPassiveMode" type="checkbox" value="1"><label for="inputFTPPassiveMode">Passiv</label><br></div>
		</div>
		
		<div class="tagTab">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.<br>
			<br>
			<div class="tagContainer"></div>
			<input class="addTag" onclick="modal(0, 'basic', '/systemStorages/add/tags/add/modal.php', 'POST', '&refererModalId=<?php echo purify($modalId); ?>', true, 1);" type="button" value="Tilføj mærke" autofocus>
		</div>
		
		<div class="buttons">
			<div class="pulseContainer"><div class="pulseCore danger"></div><div class="pulse danger"></div></div>
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Gem systemlager">
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