<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if(isset($_POST['systemEvents_id']) === false){
	$validateFlag = 400;
}
else{
	$systemEvents_id = $_POST['systemEvents_id'];
	$systemEvents_id_array = explode(',', $systemEvents_id);
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

if(isset($_POST['dataTitle']) === false){
	$dataTitle = 0;
}
else{
	$dataTitle = 1;
}

if(isset($_POST['dataMsg']) === false){
	$dataMsg = 0;
}
else{
	$dataMsg = 1;
}

if(isset($_POST['dataUsers_id']) === false){
	$dataUsers_id = 0;
}
else{
	$dataUsers_id = 1;
}

if(isset($_POST['dataDate']) === false){
	$dataDate = 0;
}
else{
	$dataDate = 1;
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

if(isset($_POST['dataIpAddress']) === false){
	$dataIpAddress = 0;
}
else{
	$dataIpAddress = 1;
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
			`c0`.`systemEvents`.`type` AS `systemEvents_type`,
			`c0`.`systemEvents`.`title` AS `systemEvents_title`,
			`c0`.`systemEvents`.`msg` AS `systemEvents_msg`,
			`c0`.`systemEvents`.`users_id` AS `systemEvents_users_id`,
			`c0`.`systemEvents`.`date` AS `systemEvents_date`,
			`c0`.`systemEvents`.`address` AS `systemEvents_address`,
			`c0`.`systemEvents`.`address2` AS `systemEvents_address2`,
			`c0`.`systemEvents`.`ipAddress` AS `systemEvents_ipAddress`,
			`c0`.`systemEvents`.`city` AS `systemEvents_city`,
			`c0`.`systemEvents`.`country` AS `systemEvents_country`,
			`c0`.`systemEvents`.`phone` AS `systemEvents_phone`,
			`c0`.`systemEvents`.`phone2` AS `systemEvents_phone2`,
			`c0`.`systemEvents`.`email` AS `systemEvents_email`,
			`c0`.`systemEvents`.`email2` AS `systemEvents_email2`
		FROM
			`c0`.`systemEvents`
		WHERE
			`c0`.`systemEvents`.`id` IN (" . implode(',', array_map('intval', $systemEvents_id_array)) . ")
			AND
			`c0`.`systemEvents`.`deleteFlag` IS NULL
			AND
			`c0`.`systemEvents`.`tempFlag` IS NULL
			AND
			`c0`.`systemEvents`.`legacyFlag` IS NULL
		ORDER BY
			`c0`.`systemEvents`.`title` ASC
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
				
				if($dataTitle == 1){
					$content = $content . $textQualifier . 'Navn' . $textQualifier . ',';
				}
				
				if($dataMsg == 1){
					$content = $content . $textQualifier . 'Supplerende navneoplysninger' . $textQualifier . ',';
				}
				
				if($dataUsers_id == 1){
					$content = $content . $textQualifier . 'CVR-nummer' . $textQualifier . ',';
				}
				
				if($dataDate == 1){
					$content = $content . $textQualifier . 'CPR-nummer' . $textQualifier . ',';
				}
				
				if($dataAddress == 1){
					$content = $content . $textQualifier . 'Adresse' . $textQualifier . ',';
				}
				
				if($dataAddress2 == 1){
					$content = $content . $textQualifier . 'Supplerende adresseoplysninger' . $textQualifier . ',';
				}
				
				if($dataIpAddress == 1){
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
				
				if($dataTitle == 1){
					$content = $content . '<th>' . $textQualifier . 'Navn' . $textQualifier . '</th>';
				}
				
				if($dataMsg == 1){
					$content = $content . '<th>' . $textQualifier . 'Supplerende navneoplysninger' . $textQualifier . '</th>';
				}
				
				if($dataUsers_id == 1){
					$content = $content . '<th>' . $textQualifier . 'CVR-nummer' . $textQualifier . '</th>';
				}
				
				if($dataDate == 1){
					$content = $content . '<th>' . $textQualifier . 'CPR-nummer' . $textQualifier . '</th>';
				}
				
				if($dataAddress == 1){
					$content = $content . '<th>' . $textQualifier . 'Adresse' . $textQualifier . '</th>';
				}
				
				if($dataAddress2 == 1){
					$content = $content . '<th>' . $textQualifier . 'Supplerende adresseoplysninger' . $textQualifier . '</th>';
				}
				
				if($dataIpAddress == 1){
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
				
				if($dataTitle == 1){
					$content = $content . $textQualifier . 'Navn' . $textQualifier . "\t";
				}
				
				if($dataMsg == 1){
					$content = $content . $textQualifier . 'Supplerende navneoplysninger' . $textQualifier . "\t";
				}
				
				if($dataUsers_id == 1){
					$content = $content . $textQualifier . 'CVR-nummer' . $textQualifier . "\t";
				}
				
				if($dataDate == 1){
					$content = $content . $textQualifier . 'CPR-nummer' . $textQualifier . "\t";
				}
				
				if($dataAddress == 1){
					$content = $content . $textQualifier . 'Adresse' . $textQualifier . "\t";
				}
				
				if($dataAddress2 == 1){
					$content = $content . $textQualifier . 'Supplerende adresseoplysninger' . $textQualifier . "\t";
				}
				
				if($dataIpAddress == 1){
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
				
				if($dataTitle == 1){
					$content = $content . $textQualifier . 'Navn' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataMsg == 1){
					$content = $content . $textQualifier . 'Supplerende navneoplysninger' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataUsers_id == 1){
					$content = $content . $textQualifier . 'CVR-nummer' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataDate == 1){
					$content = $content . $textQualifier . 'CPR-nummer' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataAddress == 1){
					$content = $content . $textQualifier . 'Adresse' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataAddress2 == 1){
					$content = $content . $textQualifier . 'Supplerende adresseoplysninger' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataIpAddress == 1){
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
				
				if($dataTitle == 1){
					$content = $content . $textQualifier . 'Navn' . $textQualifier . ',';
				}
				
				if($dataMsg == 1){
					$content = $content . $textQualifier . 'Supplerende navneoplysninger' . $textQualifier . ',';
				}
				
				if($dataUsers_id == 1){
					$content = $content . $textQualifier . 'CVR-nummer' . $textQualifier . ',';
				}
				
				if($dataDate == 1){
					$content = $content . $textQualifier . 'CPR-nummer' . $textQualifier . ',';
				}
				
				if($dataAddress == 1){
					$content = $content . $textQualifier . 'Adresse' . $textQualifier . ',';
				}
				
				if($dataAddress2 == 1){
					$content = $content . $textQualifier . 'Supplerende adresseoplysninger' . $textQualifier . ',';
				}
				
				if($dataIpAddress == 1){
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
				
				if($dataTitle == 1){
					$content = $content . '<th>' . $textQualifier . 'Navn' . $textQualifier . '</th>';
				}
				
				if($dataMsg == 1){
					$content = $content . '<th>' . $textQualifier . 'Supplerende navneoplysninger' . $textQualifier . '</th>';
				}
				
				if($dataUsers_id == 1){
					$content = $content . '<th>' . $textQualifier . 'CVR-nummer' . $textQualifier . '</th>';
				}
				
				if($dataDate == 1){
					$content = $content . '<th>' . $textQualifier . 'CPR-nummer' . $textQualifier . '</th>';
				}
				
				if($dataAddress == 1){
					$content = $content . '<th>' . $textQualifier . 'Adresse' . $textQualifier . '</th>';
				}
				
				if($dataAddress2 == 1){
					$content = $content . '<th>' . $textQualifier . 'Supplerende adresseoplysninger' . $textQualifier . '</th>';
				}
				
				if($dataIpAddress == 1){
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
				
				if($dataTitle == 1){
					$content = $content . $textQualifier . 'Navn' . $textQualifier . "\t";
				}
				
				if($dataMsg == 1){
					$content = $content . $textQualifier . 'Supplerende navneoplysninger' . $textQualifier . "\t";
				}
				
				if($dataUsers_id == 1){
					$content = $content . $textQualifier . 'CVR-nummer' . $textQualifier . "\t";
				}
				
				if($dataDate == 1){
					$content = $content . $textQualifier . 'CPR-nummer' . $textQualifier . "\t";
				}
				
				if($dataAddress == 1){
					$content = $content . $textQualifier . 'Adresse' . $textQualifier . "\t";
				}
				
				if($dataAddress2 == 1){
					$content = $content . $textQualifier . 'Supplerende adresseoplysninger' . $textQualifier . "\t";
				}
				
				if($dataIpAddress == 1){
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
				
				if($dataTitle == 1){
					$content = $content . $textQualifier . 'Navn' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataMsg == 1){
					$content = $content . $textQualifier . 'Supplerende navneoplysninger' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataUsers_id == 1){
					$content = $content . $textQualifier . 'CVR-nummer' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataDate == 1){
					$content = $content . $textQualifier . 'CPR-nummer' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataAddress == 1){
					$content = $content . $textQualifier . 'Adresse' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataAddress2 == 1){
					$content = $content . $textQualifier . 'Supplerende adresseoplysninger' . $textQualifier . $fieldDelimiter;
				}
				
				if($dataIpAddress == 1){
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
					$content = $content . $textQualifier . $row['systemEvents_type'] . $textQualifier . ',';
				}
				
				if($dataTitle == 1){
					$content = $content . $textQualifier . $row['systemEvents_title'] . $textQualifier . ',';
				}
				
				if($dataMsg == 1){
					$content = $content . $textQualifier . $row['systemEvents_msg'] . $textQualifier . ',';
				}
				
				if($dataUsers_id == 1){
					$content = $content . $textQualifier . $row['systemEvents_users_id'] . $textQualifier . ',';
				}
				
				if($dataDate == 1){
					$content = $content . $textQualifier . $row['systemEvents_date'] . $textQualifier . ',';
				}
				
				if($dataAddress == 1){
					$content = $content . $textQualifier . $row['systemEvents_address'] . $textQualifier . ',';
				}
				
				if($dataAddress2 == 1){
					$content = $content . $textQualifier . $row['systemEvents_address2'] . $textQualifier . ',';
				}
				
				if($dataIpAddress == 1){
					$content = $content . $textQualifier . $row['systemEvents_ipAddress'] . $textQualifier . ',';
				}
				
				if($dataCity == 1){
					$content = $content . $textQualifier . $row['systemEvents_city'] . $textQualifier . ',';
				}
				
				if($dataCountry == 1){
					$content = $content . $textQualifier . $row['systemEvents_country'] . $textQualifier . ',';
				}
				
				if($dataPhone == 1){
					$content = $content . $textQualifier . $row['systemEvents_phone'] . $textQualifier . ',';
				}
				
				if($dataPhone2 == 1){
					$content = $content . $textQualifier . $row['systemEvents_phone2'] . $textQualifier . ',';
				}
				
				if($dataEmail == 1){
					$content = $content . $textQualifier . $row['systemEvents_email'] . $textQualifier . ',';
				}
				
				if($dataEmail2 == 1){
					$content = $content . $textQualifier . $row['systemEvents_email2'] . $textQualifier . ',';
				}
				
				if($dataTags == 1){
					$content = $content . $textQualifier . 'TAGS' . $textQualifier . ',';
				}
				
				$content = substr_replace($content, '', -(strlen(','))) . $recordDelimiter;
			}
			else if($fileFormat == 'HTML'){
				$content = $content . '<tr>';
				
				if($dataType == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemEvents_type'] . $textQualifier . '</td>';
				}
				
				if($dataTitle == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemEvents_title'] . $textQualifier . '</td>';
				}
				
				if($dataMsg == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemEvents_msg'] . $textQualifier . '</td>';
				}
				
				if($dataUsers_id == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemEvents_users_id'] . $textQualifier . '</td>';
				}
				
				if($dataDate == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemEvents_date'] . $textQualifier . '</td>';
				}
				
				if($dataAddress == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemEvents_address'] . $textQualifier . '</td>';
				}
				
				if($dataAddress2 == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemEvents_address2'] . $textQualifier . '</td>';
				}
				
				if($dataIpAddress == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemEvents_ipAddress'] . $textQualifier . '</td>';
				}
				
				if($dataCity == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemEvents_city'] . $textQualifier . '</td>';
				}
				
				if($dataCountry == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemEvents_country'] . $textQualifier . '</td>';
				}
				
				if($dataPhone == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemEvents_phone'] . $textQualifier . '</td>';
				}
				
				if($dataPhone2 == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemEvents_phone2'] . $textQualifier . '</td>';
				}
				
				if($dataEmail == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemEvents_email'] . $textQualifier . '</td>';
				}
				
				if($dataEmail2 == 1){
					$content = $content . '<td>' . $textQualifier . $row['systemEvents_email2'] . $textQualifier . '</td>';
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
					$content = $content . '"Type":"' . $row['systemEvents_type'] . '",';
				}
				
				if($dataTitle == 1){
					$content = $content . '"Navn":"' . $row['systemEvents_title'] . '",';
				}
				
				if($dataMsg == 1){
					$content = $content . '"Supplerende navn":"' . $row['systemEvents_msg'] . '",';
				}
				
				if($dataUsers_id == 1){
					$content = $content . '"CVR-nummer":"' . $row['systemEvents_users_id'] . '",';
				}
				
				if($dataDate == 1){
					$content = $content . '"CPR-nummer":"' . $row['systemEvents_date'] . '",';
				}
				
				if($dataAddress == 1){
					$content = $content . '"Adresse":"' . $row['systemEvents_address'] . '",';
				}
				
				if($dataAddress2 == 1){
					$content = $content . '"Supplerende adresse":"' . $row['systemEvents_address2'] . '",';
				}
				
				if($dataIpAddress == 1){
					$content = $content . '"Postnummer":"' . $row['systemEvents_ipAddress'] . '",';
				}
				
				if($dataCity == 1){
					$content = $content . '"By":"' . $row['systemEvents_city'] . '",';
				}
				
				if($dataCountry == 1){
					$content = $content . '"Land":"' . $row['systemEvents_country'] . '",';
				}
				
				if($dataPhone == 1){
					$content = $content . '"Telefon":"' . $row['systemEvents_phone'] . '",';
				}
				
				if($dataPhone2 == 1){
					$content = $content . '"Sekundær telefon":"' . $row['systemEvents_phone2'] . '",';
				}
				
				if($dataEmail == 1){
					$content = $content . '"E-mail":"' . $row['systemEvents_email'] . '",';
				}
				
				if($dataEmail2 == 1){
					$content = $content . '"Sekundær e-mail":"' . $row['systemEvents_email2'] . '",';
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
					$content = $content . $textQualifier . $row['systemEvents_type'] . $textQualifier . "\t";
				}
				
				if($dataTitle == 1){
					$content = $content . $textQualifier . $row['systemEvents_title'] . $textQualifier . "\t";
				}
				
				if($dataMsg == 1){
					$content = $content . $textQualifier . $row['systemEvents_msg'] . $textQualifier . "\t";
				}
				
				if($dataUsers_id == 1){
					$content = $content . $textQualifier . $row['systemEvents_users_id'] . $textQualifier . "\t";
				}
				
				if($dataDate == 1){
					$content = $content . $textQualifier . $row['systemEvents_date'] . $textQualifier . "\t";
				}
				
				if($dataAddress == 1){
					$content = $content . $textQualifier . $row['systemEvents_address'] . $textQualifier . "\t";
				}
				
				if($dataAddress2 == 1){
					$content = $content . $textQualifier . $row['systemEvents_address2'] . $textQualifier . "\t";
				}
				
				if($dataIpAddress == 1){
					$content = $content . $textQualifier . $row['systemEvents_ipAddress'] . $textQualifier . "\t";
				}
				
				if($dataCity == 1){
					$content = $content . $textQualifier . $row['systemEvents_city'] . $textQualifier . "\t";
				}
				
				if($dataCountry == 1){
					$content = $content . $textQualifier . $row['systemEvents_country'] . $textQualifier . "\t";
				}
				
				if($dataPhone == 1){
					$content = $content . $textQualifier . $row['systemEvents_phone'] . $textQualifier . "\t";
				}
				
				if($dataPhone2 == 1){
					$content = $content . $textQualifier . $row['systemEvents_phone2'] . $textQualifier . "\t";
				}
				
				if($dataEmail == 1){
					$content = $content . $textQualifier . $row['systemEvents_email'] . $textQualifier . "\t";
				}
				
				if($dataEmail2 == 1){
					$content = $content . $textQualifier . $row['systemEvents_email2'] . $textQualifier . "\t";
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
					$content = $content . $textQualifier . $row['systemEvents_type'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataTitle == 1){
					$content = $content . $textQualifier . $row['systemEvents_title'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataMsg == 1){
					$content = $content . $textQualifier . $row['systemEvents_msg'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataUsers_id == 1){
					$content = $content . $textQualifier . $row['systemEvents_users_id'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataDate == 1){
					$content = $content . $textQualifier . $row['systemEvents_date'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataAddress == 1){
					$content = $content . $textQualifier . $row['systemEvents_address'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataAddress2 == 1){
					$content = $content . $textQualifier . $row['systemEvents_address2'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataIpAddress == 1){
					$content = $content . $textQualifier . $row['systemEvents_ipAddress'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataCity == 1){
					$content = $content . $textQualifier . $row['systemEvents_city'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataCountry == 1){
					$content = $content . $textQualifier . $row['systemEvents_country'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataPhone == 1){
					$content = $content . $textQualifier . $row['systemEvents_phone'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataPhone2 == 1){
					$content = $content . $textQualifier . $row['systemEvents_phone2'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataEmail == 1){
					$content = $content . $textQualifier . $row['systemEvents_email'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataEmail2 == 1){
					$content = $content . $textQualifier . $row['systemEvents_email2'] . $textQualifier . $fieldDelimiter;
				}
				
				if($dataTags == 1){
					$content = $content . $textQualifier . 'TAGS' . $textQualifier . $fieldDelimiter;
				}
				
				$content = substr_replace($content, '', -(strlen($fieldDelimiter))) . $recordDelimiter;
			}
			else if($fileFormat == 'XML'){
				$content = $content . '<ENTITET>';
				
				if($dataType == 1){
					$content = $content . '<Type>' . $row['systemEvents_type'] . '</Type>';
				}
				
				if($dataTitle == 1){
					$content = $content . '<Navn>' . $row['systemEvents_title'] . '</Navn>';
				}
				
				if($dataMsg == 1){
					$content = $content . '<Supplerende navn>' . $row['systemEvents_msg'] . '</Supplerende navn>';
				}
				
				if($dataUsers_id == 1){
					$content = $content . '<CVR-nummer>' . $row['systemEvents_users_id'] . '</CVR-nummer>';
				}
				
				if($dataDate == 1){
					$content = $content . '<CPR-nummer>' . $row['systemEvents_date'] . '</CPR-nummer>';
				}
				
				if($dataAddress == 1){
					$content = $content . '<Adresse>' . $row['systemEvents_address'] . '</Adresse>';
				}
				
				if($dataAddress2 == 1){
					$content = $content . '<Supplerende adresse>' . $row['systemEvents_address2'] . '/Supplerende adresse>';
				}
				
				if($dataIpAddress == 1){
					$content = $content . '<Postnummer>' . $row['systemEvents_ipAddress'] . '</Postnummer>';
				}
				
				if($dataCity == 1){
					$content = $content . '<By>' . $row['systemEvents_city'] . '</By>';
				}
				
				if($dataCountry == 1){
					$content = $content . '<Land>' . $row['systemEvents_country'] . '</Land>';
				}
				
				if($dataPhone == 1){
					$content = $content . '<Telefon>' . $row['systemEvents_phone'] . '</Telefon>';
				}
				
				if($dataPhone2 == 1){
					$content = $content . '<Sekundær telefon>' . $row['systemEvents_phone2'] . '</Sekundær telefon>';
				}
				
				if($dataEmail == 1){
					$content = $content . '<E-mail>' . $row['systemEvents_email'] . '</E-mail>';
				}
				
				if($dataEmail2 == 1){
					$content = $content . '<Sekundær e-mail>' . $row['systemEvents_email2'] . '</Sekundær e-mail>';
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
	$tempTitle = tempnam($tempDir, 'systemEvents');
	file_put_contents($tempTitle, $content);
	
	header('Content-Disposition: attachment; filename="' . rawurlencode($name . $timestamp . $fileFormatExtension) . '"');
	header('Content-Type: ' . $fileFormatContentType);
	header('Content-Length: ' . filesize($tempTitle));
	echo (file_get_contents($tempTitle));
	unlink($tempTitle);
	
	if(getSystemConfigurations('logSystemEvents') == 1 || getSystemConfigurations('logSystemEvents') == -1){
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
	
	if(getSystemConfigurations('logSystemEvents') == 1 || getSystemConfigurations('logSystemEvents') == -1){
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
	
	httpStatusCodes($validateFlag);
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>