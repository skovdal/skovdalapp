<?php
function dbConnection(){
	$systemIdentities_id = 1;
	
	$conSystemConfiguration = new mysqli('35.240.61.193', 'root', 'BU7zq9BfXU883W9U9RCHnMZdbPdeYLMCrwCiTRdrmMiXMeoXCVdsX6Q9oAPPNPJG');
	$stmtSystemConfiguration = $conSystemConfiguration->stmt_init();
	$stmtSystemConfiguration->prepare("
		SELECT
			`systemConfigurations`.`databases`.`type` AS `databases_type`,
			`systemConfigurations`.`databases`.`mySQLHost` AS `databases_mySQLHost`,
			`systemConfigurations`.`databases`.`mySQLUsername` AS `databases_mySQLUsername`,
			`systemConfigurations`.`databases`.`mySQLPassword` AS `databases_mySQLPassword`,
			`systemConfigurations`.`databases`.`mySQLDbname` AS `databases_mySQLDbname`,
			`systemConfigurations`.`databases`.`mySQLPort` AS `databases_mySQLPort`,
			`systemConfigurations`.`databases`.`mySQLSocket` AS `databases_mySQLSocket`,
			`systemConfigurations`.`databases`.`mySQLUseSSL` AS `databases_mySQLUseSSL`,
			`systemConfigurations`.`databases`.`mySQLUseSSLUseAuthentication` AS `databases_mySQLUseSSLUseAuthentication`,
			`systemConfigurations`.`databases`.`mySQLUseSSLClientKeyFile` AS `databases_mySQLUseSSLClientKeyFile`,
			`systemConfigurations`.`databases`.`mySQLUseSSLClientCertificateFile` AS `databases_mySQLUseSSLClientCertificateFile`,
			`systemConfigurations`.`databases`.`mySQLUseSSLCACertificateFile` AS `databases_mySQLUseSSLCACertificateFile`,
			`systemConfigurations`.`databases`.`mySQLUseSSLSpecifiedCipher` AS `databases_mySQLUseSSLSpecifiedCipher`
		FROM
			`systemConfigurations`.`databases`
		WHERE
			`systemConfigurations`.`databases`.`deleteFlag` IS NULL
			AND
			`systemConfigurations`.`databases`.`tempFlag` IS NULL
			AND
			`systemConfigurations`.`databases`.`legacyFlag` IS NULL
			AND
			`systemConfigurations`.`databases`.`id` = ?
		LIMIT 1
	");
	$stmtSystemConfiguration->bind_param('i', $systemIdentities_id);
	$stmtSystemConfiguration->execute();
	$resultSystemConfiguration = $stmtSystemConfiguration->get_result();
	
	if(mysqli_num_rows($resultSystemConfiguration) == 0){
	}
	else{
		while($row = mysqli_fetch_assoc($resultSystemConfiguration)){
			$databases_type = $row['databases_type'];
			$databases_mySQLHost = $row['databases_mySQLHost'];
			$databases_mySQLUsername = $row['databases_mySQLUsername'];
			$databases_mySQLPassword = $row['databases_mySQLPassword'];
			$databases_mySQLDbname = $row['databases_mySQLDbname'];
			$databases_mySQLPort = $row['databases_mySQLPort'];
			$databases_mySQLSocket = $row['databases_mySQLSocket'];
			$databases_mySQLUseSSL = $row['databases_mySQLUseSSL'];
			$databases_mySQLUseSSLUseAuthentication = $row['databases_mySQLUseSSLUseAuthentication'];
			$databases_mySQLUseSSLClientKeyFile = $row['databases_mySQLUseSSLClientKeyFile'];
			$databases_mySQLUseSSLClientCertificateFile = $row['databases_mySQLUseSSLClientCertificateFile'];
			$databases_mySQLUseSSLCACertificateFile = $row['databases_mySQLUseSSLCACertificateFile'];
			$databases_mySQLUseSSLSpecifiedCipher = $row['databases_mySQLUseSSLSpecifiedCipher'];
		}
	}
	$resultSystemConfiguration->close();
	$conSystemConfiguration->close();
	
	if($databases_type == 'MySQL'){
		return new mysqli($databases_mySQLHost, $databases_mySQLUsername, $databases_mySQLPassword, $databases_mySQLDbname, $databases_mySQLPort, $databases_mySQLSocket);
	}
}
?>