<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if(isset($_POST['systemUsers_id']) === false){
	$validateFlag = 400;
}
else{
	$systemUsers_id = $_POST['systemUsers_id'];
	$systemUsers_id_array = explode(',', $systemUsers_id);
}

if(isset($_POST['name']) === false){
	$validateFlag = 400;
}
else{
	$name = $_POST['name'];
}

if(isset($_POST['fileFormat']) === false){
	$validateFlag = 400;
}
else{
	$fileFormat = $_POST['fileFormat'];
	
	if($fileFormat == 'CSV'){
		$fileFormatContentType = 'text/csv';
		$fileFormatExtension = '.csv';
	}
	else if($fileFormat == 'HTML'){
		$fileFormatContentType = 'text/html';
		$fileFormatExtension = '.htm';
	}
	else if($fileFormat == 'JSON'){
		$fileFormatContentType = 'application/json';
		$fileFormatExtension = '.json';
	}
	else if($fileFormat == 'PDF'){
		$fileFormatContentType = 'application/pdf';
		$fileFormatExtension = '.pdf';
	}
	else if($fileFormat == 'TAB'){
		$fileFormatContentType = 'text/tab-separated-values';
		$fileFormatExtension = '.tab';
	}
	else if($fileFormat == 'TXT'){
		$fileFormatContentType = 'text/plain';
		$fileFormatExtension = '.txt';
	}
	else if($fileFormat == 'XML'){
		$fileFormatContentType = 'application/xml';
		$fileFormatExtension = '.xml';
	}
}

if(isset($_POST['timestamp']) === false){
	$validateFlag = 400;
}
else{
	$timestamp = $_POST['timestamp'];
	if($timestamp == 'NONE'){
		$timestamp = '';
	}
	else if($timestamp == 'YYYYMMDD'){
		$timestamp = '_' . date('Ymd');
	}
	else if($timestamp == 'YYYYMMDDHHNNSS'){
		$timestamp = '_' . date('YmdHis');
	}
	else if($timestamp == 'YYYY-MM-DD'){
		$timestamp = '_' . date('Y-m-d');
	}
	else if($timestamp == 'DD-MM-YYYY'){
		$timestamp = '_' . date('d-m-Y');
	}
	else if($timestamp == 'MM-DD-YYYY'){
		$timestamp = '_' . date('m-d-Y');
	}
	else if($timestamp == 'YYYY-MM-DD-HHNNSS'){
		$timestamp = '_' . date('Y-m-d-His');
	}
	else if($timestamp == 'YYYY-MM-DD-HHNNSSAM/PM'){
		$timestamp = '_' . date('Y-m-d-HisA');
	}
	else if($timestamp == 'YYYY-MM-DD-HH-NN-SS'){
		$timestamp = '_' . date('Y-m-d-H-i-s');
	}
	else if($timestamp == 'YYYY-MM-DD HHNNSS'){
		$timestamp = '_' . date('Y-m-d His');
	}
}

if(isset($_POST['dataType']) === false){
	$dataType = 0;
}
else{
	$dataType = 1;
}

if(isset($_POST['dataName']) === false){
	$dataName = 0;
}
else{
	$dataName = 1;
}

if(isset($_POST['dataName2']) === false){
	$dataName2 = 0;
}
else{
	$dataName2 = 1;
}

if(isset($_POST['dataCvrNumber']) === false){
	$dataCvrNumber = 0;
}
else{
	$dataCvrNumber = 1;
}

if(isset($_POST['dataCprNumber']) === false){
	$dataCprNumber = 0;
}
else{
	$dataCprNumber = 1;
}

if(isset($_POST['dataAddress']) === false){
	$dataAddress = 0;
}
else{
	$dataAddress = 1;
}

if(isset($_POST['dataAddress2']) === false){
	$dataAddress2 = 0;
}
else{
	$dataAddress2 = 1;
}

if(isset($_POST['dataZipCode']) === false){
	$dataZipCode = 0;
}
else{
	$dataZipCode = 1;
}

if(isset($_POST['dataCity']) === false){
	$dataCity = 0;
}
else{
	$dataCity = 1;
}

if(isset($_POST['dataCountry']) === false){
	$dataCountry = 0;
}
else{
	$dataCountry = 1;
}

if(isset($_POST['dataPhone']) === false){
	$dataPhone = 0;
}
else{
	$dataPhone = 1;
}

if(isset($_POST['dataPhone2']) === false){
	$dataPhone2 = 0;
}
else{
	$dataPhone2 = 1;
}

if(isset($_POST['dataEmail']) === false){
	$dataEmail = 0;
}
else{
	$dataEmail = 1;
}

if(isset($_POST['dataEmail2']) === false){
	$dataEmail2 = 0;
}
else{
	$dataEmail2 = 1;
}

if(isset($_POST['dataTags']) === false){
	$dataTags = 0;
}
else{
	$dataTags = 1;
}

if(isset($_POST['includeTitles']) === false){
	$validateFlag = 400;
}
else{
	$includeTitles = $_POST['includeTitles'];
}

if(isset($_POST['recordDelimiter']) === false){
	$validateFlag = 400;
}
else{
	$recordDelimiter = $_POST['recordDelimiter'];
	if($recordDelimiter == 'Automatic'){
		$recordDelimiter = PHP_EOL;
	}
	else if($recordDelimiter == 'CR'){
		$recordDelimiter = "\r";
	}
	else if($recordDelimiter == 'CRLF'){
		$recordDelimiter = "\r\n";
	}
	else if($recordDelimiter == 'LF'){
		$recordDelimiter = "\n";
	}
}

if(isset($_POST['fieldDelimiter']) === false){
	$validateFlag = 400;
}
else{
	$fieldDelimiter = $_POST['fieldDelimiter'];
}

if(isset($_POST['textQualifier']) === false){
	$validateFlag = 400;
}
else{
	$textQualifier = $_POST['textQualifier'];
	if($textQualifier == '&quot;'){
		$textQualifier = "\"";
	}
}

$systemUsers_id = $_SESSION['systemUsers_id'];

if($validateFlag == 200){
	$status = 200;
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
		INSERT INTO
			`c0`.`exports`
		(
			`c0`.`exports`.`modalId`,
			`c0`.`exports`.`date`,
			`c0`.`exports`.`users_id`,
			`c0`.`exports`.`status`
		)
		VALUES
		(
			?,
			NOW(),
			?,
			?
		)
	");
	$stmt->bind_param('sii', $modalId, $users_id, $status);
	$stmt->execute();
	setTableVersion('exports');
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
		SELECT
			`c0`.`systemUsers`.`type` AS `systemUsers_type`,
			`c0`.`systemUsers`.`name` AS `systemUsers_name`,
			`c0`.`systemUsers`.`name2` AS `systemUsers_name2`,
			`c0`.`systemUsers`.`cvrNumber` AS `systemUsers_cvrNumber`,
			`c0`.`systemUsers`.`cprNumber` AS `systemUsers_cprNumber`,
			`c0`.`systemUsers`.`address` AS `systemUsers_address`,
			`c0`.`systemUsers`.`address2` AS `systemUsers_address2`,
			`c0`.`systemUsers`.`zipCode` AS `systemUsers_zipCode`,
			`c0`.`systemUsers`.`city` AS `systemUsers_city`,
			`c0`.`systemUsers`.`country` AS `systemUsers_country`,
			`c0`.`systemUsers`.`phone` AS `systemUsers_phone`,
			`c0`.`systemUsers`.`phone2` AS `systemUsers_phone2`,
			`c0`.`systemUsers`.`email` AS `systemUsers_email`,
			`c0`.`systemUsers`.`email2` AS `systemUsers_email2`
		FROM
			`c0`.`systemUsers`
		WHERE
			`c0`.`systemUsers`.`id` IN (" . implode(',', array_map('intval', $systemUsers_id_array)) . ")
			AND
			`c0`.`systemUsers`.`deleteFlag` IS NULL
			AND
			`c0`.`systemUsers`.`tempFlag` IS NULL
			AND
			`c0`.`systemUsers`.`legacyFlag` IS NULL
		ORDER BY
			`c0`.`systemUsers`.`name` ASC
	");
	$stmt->execute();
	$result = $stmt->get_result();
	
	if(mysqli_num_rows($result) == 0){
		if($includeTitles == 0){
			$content = '';
		}
		else{
			$content = '';
			
			if($fileFormat == 'CSV'){
				if($dataType == 1){
					$content = $content . $textQualifier . 'Type' . $textQualifier . ',';
				}
				
				if($dataName == 1){
					$content = $content . $textQualifier . 'Navn' . $textQualifier . ',';
				}
				
				if($dataName2 == 1){
					$content = $content . $textQualifier . 'Supplerende navneoplysninger' . $textQualifier . ',';
				}
				
				if($dataCvrNumber == 1){
					$content = $content . $textQualifier . 'CVR-nummer' . $textQualifier . ',';
				}
				
				if($dataCprNumber == 1){
					$content = $content . $textQualifier . 'CPR-nummer' . $textQualifier . ',';
				}
				
				if($dataAddress == 1){
					$content = $content . $textQualifier . 'Adresse' . $textQualifier . ',';
				}
				
				if($dataAddress2 == 1){
					$content = $content . $textQualifier . 'Supplerende adresseoplysninger' . $textQualifier . ',';
				}
				
				if($dataZipCode == 1){
					$content = $content . $textQualifier . 'Postnummer' . $textQualifier . ',';
				}
				
				if($dataCity == 1){
					$content = $content . $textQualifier . 'By' . $textQualifier . ',';
				}
				
				if($dataCountry == 1){
					$content = $content . $textQualifier . 'Land' . $textQualifier . ',';
				}
				
				if($dataPhone == 1){
					$content = $content . $textQualifier . 'Telefon' . $textQualifier . ',';
				}
				
				if($dataPhone2 == 1){
					$content = $content . $textQualifier . 'Sekundær telefon' . $textQualifier . ',';
				}
				
				if($dataEmail == 1){
					$content = $content . $textQualifier . 'E-mail' . $textQualifier . ',';
				}
				
				if($dataEmail2 == 1){
					$content = $content . $textQualifier . 'Sekundær e-mail' . $textQualifier . ',';
				}
				
				if($dataTags == 1){
					$content = $content . $textQualifier . 'Mærker' . $textQualifier . ',';
				}
				
				$content = substr_replace($content, '', -(strlen(','))) . $recordDelimiter;
			}
			else if($fileFormat == 'HTML'){
				$content = $content . '<tr>';
				
				if($dataType == 1){
					$content = $content . '<th>' . $textQualifier . 'Type' . $textQualifier . '</th>';
				}
				
				if($dataName == 1){
					$content = $content . '<th>' . $textQualifier . 'Navn' . $textQualifier . '</th>';
				}
				
				if($dataName2 == 1){
					$content = $content . '<th>' . $textQualifier . 'Supplerende navneoplysninger' . $textQualifier . '</th>';
				}
				
				if($dataCvrNumber == 1){
					$content = $content . '<th>' . $textQualifier . 'CVR-nummer' . $textQualifier . '</th>';
				}
				
				if($dataCprNumber == 1){
					$content = $content . '<th>' . $textQualifier . 'CPR-nummer' . $textQualifier . '</th>';
				}
				
				if($dataAddress == 1){
					$content = $content . '<th>' . $textQualifier . 'Adresse' . $textQualifier . '</th>';
				}
				
				if($dataAddress2 == 1){
					$content = $content . '<th>' . $textQualifier . 'Supplerende adresseoplysninger' . $textQualifier . '</th>';
				}
				
				if($dataZipCode == 1){
					$content = $content . '<th>' . $textQualifier . 'Postnummer' . $textQualifier . '</th>';
				}
				
				if($dataCity == 1){
					$content = $content . '<th>' . $textQualifier . 'By' . $textQualifier . '</th>';
				}
				
				if($dataCountry == 1){
					$content = $content . '<th>' . $textQualifier . 'Land' . $textQualifier . '</th>';
				}
				
				if($dataPhone == 1){
					$content = $content . '<th>' . $textQualifier . 'Telefon' . $textQualifier . '</th>';
				}
				
				if($dataPhone2 == 1){
					$content = $content . '<th>' . $textQualifier . 'Sekundær telefon' . $textQualifier . '</th>';
				}
				
				if($dataEmail == 1){
					$content = $content . '<th>' . $textQualifier . 'E-mail' . $textQualifier . '</th>';
				}
				
				if($dataEmail2 == 1){
					$content = $content . '<th>' . $textQualifier . 'Sekundær e-mail' . $textQualifier . '</th>';
				}
				
				if($dataTags == 1){
					$content = $content . '<th>' . $textQualifier . 'Mærker' . $textQualifier . '</th>';
				}
				
				$content = $content . '</tr>';
			}
			else if($fileFormat == 'TAB'){
				if($dataType == 1){
					$content = $content . $textQualifier . 'Type' . $textQualifier . "\t";
				}
				
				if($dataName == 1){
					$content = $content . $textQualifier . 'Navn' . $textQualifier . "\t";
				}
				
				if($dataName2 == 1){
					$content = $content . $textQualifier . 'Supplerende navneoplysninger' . $textQualifier . "\t";
				}
				
				if($dataCvrNumber == 1){
					$content = $content . $textQualifier . 'CVR-nummer' . $textQualifier . "\t";
				}
				
				if($dataCprNumber == 1){
					$content = $content . $textQualifier . 'CPR-nummer' . $textQualifier . "\t";
				}
				
				if($dataAddress == 1){
					$content = $content . $textQualifier . 'Adresse' . $textQualifier . "\t";
				}
				
				if($dataAddress2 == 1){
					$content = $content . $textQualifier . 'Supplerende adresseoplysninger' . $textQualifier . "\t";
				}
				
				if($dataZipCode == 1){
					$content = $content . $textQualifier . 'Postnummer' . $textQualifier . "\t";
				}
				
				if($dataCity == 1){
					$content = $content . $textQualifier . 'By' . $textQualifier . "\t";
				}
				
				if($dataCountry == 1){
					$content = $content . $textQualifier . 'Land' . $textQualifier . "\t";
				}
				
				if($dataPhone == 1){
					$content = $content . $textQualifier . 'Telefon' . $textQualifier . "\t";
				}
				
				if($dataPhone2 == 1){
					$content = $content . $textQualifier . 'Sekundær telefon' . $textQualifier . "\t";
				}
				
				if($dataEmail == 1){
					$content = $content . $textQualifier . 'E-mail' . $textQualifier . "\t";
				}
				
				if($dataEmail2 == 1){
					$content = $content . $textQualifier . 'Sekundær e-mail' . $textQualifier . "\t";
				}
				
				if($dataTags == 1){
					$content = $content . $textQualifier . 'Mærker' . $textQualifier . "\t";
				}
				
				$content = substr_replace($content, '', -(strlen("\t"))) . $recordDelimiter;
			}
			else if($fileFormat == 'TXT'){
				if($dataType == 1){
					$content = $content . $textQualifier . 'Type' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataName == 1){
					$content = $content . $textQualifier . 'Navn' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataName2 == 1){
					$content = $content . $textQualifier . 'Supplerende navneoplysninger' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataCvrNumber == 1){
					$content = $content . $textQualifier . 'CVR-nummer' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataCprNumber == 1){
					$content = $content . $textQualifier . 'CPR-nummer' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataAddress == 1){
					$content = $content . $textQualifier . 'Adresse' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataAddress2 == 1){
					$content = $content . $textQualifier . 'Supplerende adresseoplysninger' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataZipCode == 1){
					$content = $content . $textQualifier . 'Postnummer' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataCity == 1){
					$content = $content . $textQualifier . 'By' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataCountry == 1){
					$content = $content . $textQualifier . 'Land' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataPhone == 1){
					$content = $content . $textQualifier . 'Telefon' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataPhone2 == 1){
					$content = $content . $textQualifier . 'Sekundær telefon' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataEmail == 1){
					$content = $content . $textQualifier . 'E-mail' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataEmail2 == 1){
					$content = $content . $textQualifier . 'Sekundær e-mail' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataTags == 1){
					$content = $content . $textQualifier . 'Mærker' . $textQualifier . $fieldDelimiter;
				}
				
				$content = substr_replace($content, '', -(strlen($fieldDelimiter))) . $recordDelimiter;
			}
		}
	}
	else{
		if($includeTitles == 0){
			$content = '';
		}
		else{
			$content = '';
			
			if($fileFormat == 'CSV'){
				if($dataType == 1){
					$content = $content . $textQualifier . 'Type' . $textQualifier . ',';
				}
				
				if($dataName == 1){
					$content = $content . $textQualifier . 'Navn' . $textQualifier . ',';
				}
				
				if($dataName2 == 1){
					$content = $content . $textQualifier . 'Supplerende navneoplysninger' . $textQualifier . ',';
				}
				
				if($dataCvrNumber == 1){
					$content = $content . $textQualifier . 'CVR-nummer' . $textQualifier . ',';
				}
				
				if($dataCprNumber == 1){
					$content = $content . $textQualifier . 'CPR-nummer' . $textQualifier . ',';
				}
				
				if($dataAddress == 1){
					$content = $content . $textQualifier . 'Adresse' . $textQualifier . ',';
				}
				
				if($dataAddress2 == 1){
					$content = $content . $textQualifier . 'Supplerende adresseoplysninger' . $textQualifier . ',';
				}
				
				if($dataZipCode == 1){
					$content = $content . $textQualifier . 'Postnummer' . $textQualifier . ',';
				}
				
				if($dataCity == 1){
					$content = $content . $textQualifier . 'By' . $textQualifier . ',';
				}
				
				if($dataCountry == 1){
					$content = $content . $textQualifier . 'Land' . $textQualifier . ',';
				}
				
				if($dataPhone == 1){
					$content = $content . $textQualifier . 'Telefon' . $textQualifier . ',';
				}
				
				if($dataPhone2 == 1){
					$content = $content . $textQualifier . 'Sekundær telefon' . $textQualifier . ',';
				}
				
				if($dataEmail == 1){
					$content = $content . $textQualifier . 'E-mail' . $textQualifier . ',';
				}
				
				if($dataEmail2 == 1){
					$content = $content . $textQualifier . 'Sekundær e-mail' . $textQualifier . ',';
				}
				
				if($dataTags == 1){
					$content = $content . $textQualifier . 'Mærker' . $textQualifier . ',';
				}
				
				$content = substr_replace($content, '', -(strlen(','))) . $recordDelimiter;
			}
			else if($fileFormat == 'HTML'){
				$content = $content . '<tr>';
				
				if($dataType == 1){
					$content = $content . '<th>' . $textQualifier . 'Type' . $textQualifier . '</th>';
				}
				
				if($dataName == 1){
					$content = $content . '<th>' . $textQualifier . 'Navn' . $textQualifier . '</th>';
				}
				
				if($dataName2 == 1){
					$content = $content . '<th>' . $textQualifier . 'Supplerende navneoplysninger' . $textQualifier . '</th>';
				}
				
				if($dataCvrNumber == 1){
					$content = $content . '<th>' . $textQualifier . 'CVR-nummer' . $textQualifier . '</th>';
				}
				
				if($dataCprNumber == 1){
					$content = $content . '<th>' . $textQualifier . 'CPR-nummer' . $textQualifier . '</th>';
				}
				
				if($dataAddress == 1){
					$content = $content . '<th>' . $textQualifier . 'Adresse' . $textQualifier . '</th>';
				}
				
				if($dataAddress2 == 1){
					$content = $content . '<th>' . $textQualifier . 'Supplerende adresseoplysninger' . $textQualifier . '</th>';
				}
				
				if($dataZipCode == 1){
					$content = $content . '<th>' . $textQualifier . 'Postnummer' . $textQualifier . '</th>';
				}
				
				if($dataCity == 1){
					$content = $content . '<th>' . $textQualifier . 'By' . $textQualifier . '</th>';
				}
				
				if($dataCountry == 1){
					$content = $content . '<th>' . $textQualifier . 'Land' . $textQualifier . '</th>';
				}
				
				if($dataPhone == 1){
					$content = $content . '<th>' . $textQualifier . 'Telefon' . $textQualifier . '</th>';
				}
				
				if($dataPhone2 == 1){
					$content = $content . '<th>' . $textQualifier . 'Sekundær telefon' . $textQualifier . '</th>';
				}
				
				if($dataEmail == 1){
					$content = $content . '<th>' . $textQualifier . 'E-mail' . $textQualifier . '</th>';
				}
				
				if($dataEmail2 == 1){
					$content = $content . '<th>' . $textQualifier . 'Sekundær e-mail' . $textQualifier . '</th>';
				}
				
				if($dataTags == 1){
					$content = $content . '<th>' . $textQualifier . 'Mærker' . $textQualifier . '</th>';
				}
				
				$content = $content . '</tr>';
			}
			else if($fileFormat == 'TAB'){
				if($dataType == 1){
					$content = $content . $textQualifier . 'Type' . $textQualifier . "\t";
				}
				
				if($dataName == 1){
					$content = $content . $textQualifier . 'Navn' . $textQualifier . "\t";
				}
				
				if($dataName2 == 1){
					$content = $content . $textQualifier . 'Supplerende navneoplysninger' . $textQualifier . "\t";
				}
				
				if($dataCvrNumber == 1){
					$content = $content . $textQualifier . 'CVR-nummer' . $textQualifier . "\t";
				}
				
				if($dataCprNumber == 1){
					$content = $content . $textQualifier . 'CPR-nummer' . $textQualifier . "\t";
				}
				
				if($dataAddress == 1){
					$content = $content . $textQualifier . 'Adresse' . $textQualifier . "\t";
				}
				
				if($dataAddress2 == 1){
					$content = $content . $textQualifier . 'Supplerende adresseoplysninger' . $textQualifier . "\t";
				}
				
				if($dataZipCode == 1){
					$content = $content . $textQualifier . 'Postnummer' . $textQualifier . "\t";
				}
				
				if($dataCity == 1){
					$content = $content . $textQualifier . 'By' . $textQualifier . "\t";
				}
				
				if($dataCountry == 1){
					$content = $content . $textQualifier . 'Land' . $textQualifier . "\t";
				}
				
				if($dataPhone == 1){
					$content = $content . $textQualifier . 'Telefon' . $textQualifier . "\t";
				}
				
				if($dataPhone2 == 1){
					$content = $content . $textQualifier . 'Sekundær telefon' . $textQualifier . "\t";
				}
				
				if($dataEmail == 1){
					$content = $content . $textQualifier . 'E-mail' . $textQualifier . "\t";
				}
				
				if($dataEmail2 == 1){
					$content = $content . $textQualifier . 'Sekundær e-mail' . $textQualifier . "\t";
				}
				
				if($dataTags == 1){
					$content = $content . $textQualifier . 'Mærker' . $textQualifier . "\t";
				}
				
				$content = substr_replace($content, '', -(strlen("\t"))) . $recordDelimiter;
			}
			else if($fileFormat == 'TXT'){
				if($dataType == 1){
					$content = $content . $textQualifier . 'Type' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataName == 1){
					$content = $content . $textQualifier . 'Navn' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataName2 == 1){
					$content = $content . $textQualifier . 'Supplerende navneoplysninger' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataCvrNumber == 1){
					$content = $content . $textQualifier . 'CVR-nummer' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataCprNumber == 1){
					$content = $content . $textQualifier . 'CPR-nummer' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataAddress == 1){
					$content = $content . $textQualifier . 'Adresse' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataAddress2 == 1){
					$content = $content . $textQualifier . 'Supplerende adresseoplysninger' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataZipCode == 1){
					$content = $content . $textQualifier . 'Postnummer' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataCity == 1){
					$content = $content . $textQualifier . 'By' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataCountry == 1){
					$content = $content . $textQualifier . 'Land' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataPhone == 1){
					$content = $content . $textQualifier . 'Telefon' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataPhone2 == 1){
					$content = $content . $textQualifier . 'Sekundær telefon' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataEmail == 1){
					$content = $content . $textQualifier . 'E-mail' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataEmail2 == 1){
					$content = $content . $textQualifier . 'Sekundær e-mail' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataTags == 1){
					$content = $content . $textQualifier . 'Mærker' . $textQualifier . $fieldDelimiter;
				}
				
				$content = substr_replace($content, '', -(strlen($fieldDelimiter))) . $recordDelimiter;
			}
		}
		
		while($row = mysqli_fetch_assoc($result)){
			if($fileFormat == 'CSV'){
				if($content == ''){
					$content = '';
				}
				else{
					$content = $content;
				}
				
				if($dataType == 1){
					$content = $content . $textQualifier . $row['systemUsers_type'] . $textQualifier . ',';
				}
				
				if($dataName == 1){
					$content = $content . $textQualifier . $row['systemUsers_name'] . $textQualifier . ',';
				}
				
				if($dataName2 == 1){
					$content = $content . $textQualifier . $row['systemUsers_name2'] . $textQualifier . ',';
				}
				
				if($dataCvrNumber == 1){
					$content = $content . $textQualifier . $row['systemUsers_cvrNumber'] . $textQualifier . ',';
				}
				
				if($dataCprNumber == 1){
					$content = $content . $textQualifier . $row['systemUsers_cprNumber'] . $textQualifier . ',';
				}
				
				if($dataAddress == 1){
					$content = $content . $textQualifier . $row['systemUsers_address'] . $textQualifier . ',';
				}
				
				if($dataAddress2 == 1){
					$content = $content . $textQualifier . $row['systemUsers_address2'] . $textQualifier . ',';
				}
				
				if($dataZipCode == 1){
					$content = $content . $textQualifier . $row['systemUsers_zipCode'] . $textQualifier . ',';
				}
				
				if($dataCity == 1){
					$content = $content . $textQualifier . $row['systemUsers_city'] . $textQualifier . ',';
				}
				
				if($dataCountry == 1){
					$content = $content . $textQualifier . $row['systemUsers_country'] . $textQualifier . ',';
				}
				
				if($dataPhone == 1){
					$content = $content . $textQualifier . $row['systemUsers_phone'] . $textQualifier . ',';
				}
				
				if($dataPhone2 == 1){
					$content = $content . $textQualifier . $row['systemUsers_phone2'] . $textQualifier . ',';
				}
				
				if($dataEmail == 1){
					$content = $content . $textQualifier . $row['systemUsers_email'] . $textQualifier . ',';
				}
				
				if($dataEmail2 == 1){
					$content = $content . $textQualifier . $row['systemUsers_email2'] . $textQualifier . ',';
				}
				
				if($dataTags == 1){
					$content = $content . $textQualifier . 'TAGS' . $textQualifier . ',';
				}
				
				$content = substr_replace($content, '', -(strlen(','))) . $recordDelimiter;
			}
			else if($fileFormat == 'HTML'){
				$content = $content . '<tr>';
				
				if($dataType == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemUsers_type'] . $textQualifier . '</td>';
				}
				
				if($dataName == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemUsers_name'] . $textQualifier . '</td>';
				}
				
				if($dataName2 == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemUsers_name2'] . $textQualifier . '</td>';
				}
				
				if($dataCvrNumber == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemUsers_cvrNumber'] . $textQualifier . '</td>';
				}
				
				if($dataCprNumber == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemUsers_cprNumber'] . $textQualifier . '</td>';
				}
				
				if($dataAddress == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemUsers_address'] . $textQualifier . '</td>';
				}
				
				if($dataAddress2 == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemUsers_address2'] . $textQualifier . '</td>';
				}
				
				if($dataZipCode == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemUsers_zipCode'] . $textQualifier . '</td>';
				}
				
				if($dataCity == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemUsers_city'] . $textQualifier . '</td>';
				}
				
				if($dataCountry == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemUsers_country'] . $textQualifier . '</td>';
				}
				
				if($dataPhone == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemUsers_phone'] . $textQualifier . '</td>';
				}
				
				if($dataPhone2 == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemUsers_phone2'] . $textQualifier . '</td>';
				}
				
				if($dataEmail == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemUsers_email'] . $textQualifier . '</td>';
				}
				
				if($dataEmail2 == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemUsers_email2'] . $textQualifier . '</td>';
				}
				
				if($dataTags == 1){
					$content = $content . '<td>' . $textQualifier . 'TAGS' . $textQualifier . '</td>';
				}
				
				$content = $content . '</tr>';
			}
			else if($fileFormat == 'JSON'){
				if($content == ''){
					$content = $content . '{';
				}
				else{
					$content = $content . ',{';
				}
				
				if($dataType == 1){
					$content = $content . '"Type":"' . $row['systemUsers_type'] . '",';
				}
				
				if($dataName == 1){
					$content = $content . '"Navn":"' . $row['systemUsers_name'] . '",';
				}
				
				if($dataName2 == 1){
					$content = $content . '"Supplerende navn":"' . $row['systemUsers_name2'] . '",';
				}
				
				if($dataCvrNumber == 1){
					$content = $content . '"CVR-nummer":"' . $row['systemUsers_cvrNumber'] . '",';
				}
				
				if($dataCprNumber == 1){
					$content = $content . '"CPR-nummer":"' . $row['systemUsers_cprNumber'] . '",';
				}
				
				if($dataAddress == 1){
					$content = $content . '"Adresse":"' . $row['systemUsers_address'] . '",';
				}
				
				if($dataAddress2 == 1){
					$content = $content . '"Supplerende adresse":"' . $row['systemUsers_address2'] . '",';
				}
				
				if($dataZipCode == 1){
					$content = $content . '"Postnummer":"' . $row['systemUsers_zipCode'] . '",';
				}
				
				if($dataCity == 1){
					$content = $content . '"By":"' . $row['systemUsers_city'] . '",';
				}
				
				if($dataCountry == 1){
					$content = $content . '"Land":"' . $row['systemUsers_country'] . '",';
				}
				
				if($dataPhone == 1){
					$content = $content . '"Telefon":"' . $row['systemUsers_phone'] . '",';
				}
				
				if($dataPhone2 == 1){
					$content = $content . '"Sekundær telefon":"' . $row['systemUsers_phone2'] . '",';
				}
				
				if($dataEmail == 1){
					$content = $content . '"E-mail":"' . $row['systemUsers_email'] . '",';
				}
				
				if($dataEmail2 == 1){
					$content = $content . '"Sekundær e-mail":"' . $row['systemUsers_email2'] . '",';
				}
				
				if($dataTags == 1){
					$content = $content . '"Mærker":"' . 'TAGS' . '",';
				}
				
				$content = substr_replace($content, '', -(strlen(','))) . '}';
			}
			else if($fileFormat == 'TAB'){
				if($content == ''){
					$content = '';
				}
				else{
					$content = $content;
				}
				
				if($dataType == 1){
					$content = $content . $textQualifier . $row['systemUsers_type'] . $textQualifier . "\t";
				}
				
				if($dataName == 1){
					$content = $content . $textQualifier . $row['systemUsers_name'] . $textQualifier . "\t";
				}
				
				if($dataName2 == 1){
					$content = $content . $textQualifier . $row['systemUsers_name2'] . $textQualifier . "\t";
				}
				
				if($dataCvrNumber == 1){
					$content = $content . $textQualifier . $row['systemUsers_cvrNumber'] . $textQualifier . "\t";
				}
				
				if($dataCprNumber == 1){
					$content = $content . $textQualifier . $row['systemUsers_cprNumber'] . $textQualifier . "\t";
				}
				
				if($dataAddress == 1){
					$content = $content . $textQualifier . $row['systemUsers_address'] . $textQualifier . "\t";
				}
				
				if($dataAddress2 == 1){
					$content = $content . $textQualifier . $row['systemUsers_address2'] . $textQualifier . "\t";
				}
				
				if($dataZipCode == 1){
					$content = $content . $textQualifier . $row['systemUsers_zipCode'] . $textQualifier . "\t";
				}
				
				if($dataCity == 1){
					$content = $content . $textQualifier . $row['systemUsers_city'] . $textQualifier . "\t";
				}
				
				if($dataCountry == 1){
					$content = $content . $textQualifier . $row['systemUsers_country'] . $textQualifier . "\t";
				}
				
				if($dataPhone == 1){
					$content = $content . $textQualifier . $row['systemUsers_phone'] . $textQualifier . "\t";
				}
				
				if($dataPhone2 == 1){
					$content = $content . $textQualifier . $row['systemUsers_phone2'] . $textQualifier . "\t";
				}
				
				if($dataEmail == 1){
					$content = $content . $textQualifier . $row['systemUsers_email'] . $textQualifier . "\t";
				}
				
				if($dataEmail2 == 1){
					$content = $content . $textQualifier . $row['systemUsers_email2'] . $textQualifier . "\t";
				}
				
				if($dataTags == 1){
					$content = $content . $textQualifier . 'TAGS' . $textQualifier . "\t";
				}
				
				$content = substr_replace($content, '', -(strlen("\t"))) . $recordDelimiter;
			}
			else if($fileFormat == 'TXT'){
				if($content == ''){
					$content = '';
				}
				else{
					$content = $content;
				}
				
				if($dataType == 1){
					$content = $content . $textQualifier . $row['systemUsers_type'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataName == 1){
					$content = $content . $textQualifier . $row['systemUsers_name'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataName2 == 1){
					$content = $content . $textQualifier . $row['systemUsers_name2'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataCvrNumber == 1){
					$content = $content . $textQualifier . $row['systemUsers_cvrNumber'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataCprNumber == 1){
					$content = $content . $textQualifier . $row['systemUsers_cprNumber'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataAddress == 1){
					$content = $content . $textQualifier . $row['systemUsers_address'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataAddress2 == 1){
					$content = $content . $textQualifier . $row['systemUsers_address2'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataZipCode == 1){
					$content = $content . $textQualifier . $row['systemUsers_zipCode'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataCity == 1){
					$content = $content . $textQualifier . $row['systemUsers_city'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataCountry == 1){
					$content = $content . $textQualifier . $row['systemUsers_country'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataPhone == 1){
					$content = $content . $textQualifier . $row['systemUsers_phone'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataPhone2 == 1){
					$content = $content . $textQualifier . $row['systemUsers_phone2'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataEmail == 1){
					$content = $content . $textQualifier . $row['systemUsers_email'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataEmail2 == 1){
					$content = $content . $textQualifier . $row['systemUsers_email2'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataTags == 1){
					$content = $content . $textQualifier . 'TAGS' . $textQualifier . $fieldDelimiter;
				}
				
				$content = substr_replace($content, '', -(strlen($fieldDelimiter))) . $recordDelimiter;
			}
			else if($fileFormat == 'XML'){
				$content = $content . '<ENTITET>';
				
				if($dataType == 1){
					$content = $content . '<Type>' . $row['systemUsers_type'] . '</Type>';
				}
				
				if($dataName == 1){
					$content = $content . '<Navn>' . $row['systemUsers_name'] . '</Navn>';
				}
				
				if($dataName2 == 1){
					$content = $content . '<Supplerende navn>' . $row['systemUsers_name2'] . '</Supplerende navn>';
				}
				
				if($dataCvrNumber == 1){
					$content = $content . '<CVR-nummer>' . $row['systemUsers_cvrNumber'] . '</CVR-nummer>';
				}
				
				if($dataCprNumber == 1){
					$content = $content . '<CPR-nummer>' . $row['systemUsers_cprNumber'] . '</CPR-nummer>';
				}
				
				if($dataAddress == 1){
					$content = $content . '<Adresse>' . $row['systemUsers_address'] . '</Adresse>';
				}
				
				if($dataAddress2 == 1){
					$content = $content . '<Supplerende adresse>' . $row['systemUsers_address2'] . '/Supplerende adresse>';
				}
				
				if($dataZipCode == 1){
					$content = $content . '<Postnummer>' . $row['systemUsers_zipCode'] . '</Postnummer>';
				}
				
				if($dataCity == 1){
					$content = $content . '<By>' . $row['systemUsers_city'] . '</By>';
				}
				
				if($dataCountry == 1){
					$content = $content . '<Land>' . $row['systemUsers_country'] . '</Land>';
				}
				
				if($dataPhone == 1){
					$content = $content . '<Telefon>' . $row['systemUsers_phone'] . '</Telefon>';
				}
				
				if($dataPhone2 == 1){
					$content = $content . '<Sekundær telefon>' . $row['systemUsers_phone2'] . '</Sekundær telefon>';
				}
				
				if($dataEmail == 1){
					$content = $content . '<E-mail>' . $row['systemUsers_email'] . '</E-mail>';
				}
				
				if($dataEmail2 == 1){
					$content = $content . '<Sekundær e-mail>' . $row['systemUsers_email2'] . '</Sekundær e-mail>';
				}
				
				if($dataTags == 1){
					$content = $content . '<Mærker>' . 'TAGS' . '</Mærker>';
				}
				
				$content = $content . '</ENTITET>';
			}
		}
	}
	$result->close();
	
	if(isset($content) === false){
		$content = '';
	}
	else{
		if($fileFormat == 'CSV'){
			$content = $content;
		}
		else if($fileFormat == 'HTML'){
			$content = '<table border="1">' . $content . '</table>';
		}
		else if($fileFormat == 'JSON'){
			$content = '{' . '"ENTITETER":[' . $content . ']' . '}';
		}
		else if($fileFormat == 'TAB'){
			$content = $content;
		}
		else if($fileFormat == 'TXT'){
			$content = $content;
		}
		else if($fileFormat == 'XML'){
			$content = '<?xml version="1.0"?><ENTITETER>' . $content . '</ENTITETER>';
		}
	}
	
	$tempDir = sys_get_temp_dir();
	$tempName = tempnam($tempDir, 'systemUsers');
	file_put_contents($tempName, $content);
	
	header('Content-Disposition: attachment; filename="' . rawurlencode($name . $timestamp . $fileFormatExtension) . '"');
	header('Content-Type: ' . $fileFormatContentType);
	header('Content-Length: ' . filesize($tempName));
	echo (file_get_contents($tempName));
	unlink($tempName);
	
	if(getSystemConfigurations('logSystemUsers') == 1 || getSystemConfigurations('logSystemUsers') == -1){
		$type = 'add';
		$trigger_systemUsers_id = $_SESSION['systemUsers_id'];
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
			$systemUsers_id,
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
	$status = $validateFlag;
	
	if(isset($con) === false){$con = dbConnection();}
	$stmt = $con->stmt_init();
	$stmt->prepare("
		INSERT INTO
			`c0`.`exports`
		(
			`modalId`,
			`date`,
			`users_id`,
			`status`
		)
		VALUES
		(
			?,
			NOW(),
			?,
			?
		)
	");
	$stmt->bind_param('sii', $modalId, $users_id, $status);
	$stmt->execute();
	setTableVersion('exports');

	if(getSystemConfigurations('logSystemUsers') == 1 || getSystemConfigurations('logSystemUsers') == -1){
		$type = 'add';
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
			$systemUsers_id,
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
	
	httpStatusCodes($validateFlag);
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>