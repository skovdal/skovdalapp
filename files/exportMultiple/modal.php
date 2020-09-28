<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if(isset($_POST['files_id']) === false){
	$validateFlag = 400;
}
else{
	$files_id = $_POST['files_id'];
}

if($validateFlag == 200){
?>
	<h1>Eksporter markerede filer</h1>
	<ul>
		<li class="active" onclick="modalTab('<?php echo purify($modalId); ?>', 1);">
			Generelt
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 2);">
			Data
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 3);">
			Datoer
		</li>
		<li onclick="modalTab('<?php echo purify($modalId); ?>', 4);">
			Yderligere indstillinger
		</li>
	</ul>
	
	<form action="/files/exportMultiple/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<input name="files_id" type="hidden" value="<?php echo purify($files_id); ?>">
		<div>
			Eksporter <?php echo substr_count(purify($files_id),',') +1; ?> <?php if(substr_count(purify($files_id),',') == 0){echo 'fil';}else{echo 'filer';} ?>.<br>
			<br>
			<input id="inputName" name="name" pattern=".{3,}" placeholder="filer" type="text" value="filer" required autofocus><label for="inputName">Filnavn</label><br>
			<select id="inputFileFormat" name="fileFormat" required>
				<option value="TXT">Brugerdefineret feltskilletegn (.txt)</option>
				<option value="HTML">HTML-tabel (.htm)</option>
				<option value="JSON">JSON-format (.json)</option>
				<option value="CSV" selected>Kommasepareret (.csv)</option>
				<option value="TAB">Tabsepareret (.tab)</option>
				<option value="XML">XML-format (.xml)</option>
			</select><label for="inputFileFormat">Filformat</label><br>
			<select id="inputEncoding" name="encoding" required>
				<option value="big5">big5</option>
				<option value="big5-hkscs">big5-hkscs</option>
				<option value="cp437">cp437</option>
				<option value="cp737">cp737</option>
				<option value="cp775">cp775</option>
				<option value="cp850">cp850</option>
				<option value="cp851">cp851</option>
				<option value="cp852">cp852</option>
				<option value="cp855">cp855</option>
				<option value="cp857">cp857</option>
				<option value="cp860">cp860</option>
				<option value="cp861">cp861</option>
				<option value="cp862">cp862</option>
				<option value="cp863">cp863</option>
				<option value="cp864">cp864</option>
				<option value="cp865">cp865</option>
				<option value="cp866">cp866</option>
				<option value="cp869">cp869</option>
				<option value="cp874">cp874</option>
				<option value="cp936">cp936</option>
				<option value="cp949">cp949</option>
				<option value="cp950">cp950</option>
				<option value="euc-jp">euc-jp</option>
				<option value="euc-kr">euc-kr</option>
				<option value="euc-tw">euc-tw</option>
				<option value="gb2312">gb2312</option>
				<option value="gb18030">gb18030</option>
				<option value="GBK">GBK</option>
				<option value="hz-gb-2312">hz-gb-2312</option>
				<option value="ibm037">ibm037</option>
				<option value="iso-2022-cn">iso-2022-cn</option>
				<option value="iso-2022-jp">iso-2022-jp</option>
				<option value="iso-2022-jp-1">iso-2022-jp-1</option>
				<option value="iso-2022-jp-2">iso-2022-jp-2</option>
				<option value="iso-2022-kr">iso-2022-kr</option>
				<option value="iso-8859-1">iso-8859-1</option>
				<option value="iso-8859-2">iso-8859-2</option>
				<option value="iso-8859-3">iso-8859-3</option>
				<option value="iso-8859-4">iso-8859-4</option>
				<option value="iso-8859-5">iso-8859-5</option>
				<option value="iso-8859-6">iso-8859-6</option>
				<option value="iso-8859-7">iso-8859-7</option>
				<option value="iso-8859-8">iso-8859-8</option>
				<option value="iso-8859-9">iso-8859-9</option>
				<option value="iso-8859-10">iso-8859-10</option>
				<option value="iso-8859-11">iso-8859-11</option>
				<option value="iso-8859-13">iso-8859-13</option>
				<option value="iso-8859-14">iso-8859-14</option>
				<option value="iso-8859-15">iso-8859-15</option>
				<option value="iso-8859-16">iso-8859-16</option>
				<option value="Keyboard Symbols (macOS)">Keyboard Symbols (macOS)</option>
				<option value="koi8-r">koi8-r</option>
				<option value="koi8-u">koi8-u</option>
				<option value="macintosh">macintosh</option>
				<option value="Non-lossy ASCII">Non-lossy ASCII</option>
				<option value="Shift_JIS">Shift_JIS</option>
				<option value="shift_jis">shift_jis</option>
				<option value="Traditional Chinese (Big 5-E)">Traditional Chinese (Big 5-E)</option>
				<option value="us-ascii">us-ascii</option>
				<option value="utf-7">utf-7</option>
				<option value="utf-8" selected>utf-8</option>
				<option value="utf-16">utf-16</option>
				<option value="utf-16be">utf-16be</option>
				<option value="utf-16le">utf-16le</option>
				<option value="utf-32">utf-32</option>
				<option value="utf-32be">utf-32be</option>
				<option value="utf-32le">utf-32le</option>
				<option value="Western (EBCDIC Latin Core)">Western (EBCDIC Latin Core)</option>
				<option value="windows-1250">windows-1250</option>
				<option value="windows-1251">windows-1251</option>
				<option value="windows-1252">windows-1252</option>
				<option value="windows-1253">windows-1253</option>
				<option value="windows-1254">windows-1254</option>
				<option value="windows-1255">windows-1255</option>
				<option value="windows-1256">windows-1256</option>
				<option value="windows-1257">windows-1257</option>
				<option value="windows-1258">windows-1258</option>
				<option value="x-mac-arabic">x-mac-arabic</option>
				<option value="x-mac-celtic">x-mac-celtic</option>
				<option value="x-mac-centraleurroman">x-mac-centraleurroman</option>
				<option value="x-mac-croatian">x-mac-croatian</option>
				<option value="x-mac-cyrillic">x-mac-cyrillic</option>
				<option value="x-mac-devanagari">x-mac-devanagari</option>
				<option value="x-mac-dingbats">x-mac-dingbats</option>
				<option value="x-mac-farsi">x-mac-farsi</option>
				<option value="x-mac-gaelic">x-mac-gaelic</option>
				<option value="x-mac-greek">x-mac-greek</option>
				<option value="x-mac-gujarati">x-mac-gujarati</option>
				<option value="x-mac-gurmukhi">x-mac-gurmukhi</option>
				<option value="x-mac-hebrew">x-mac-hebrew</option>
				<option value="x-mac-icelandic">x-mac-icelandic</option>
				<option value="x-mac-inuit">x-mac-inuit</option>
				<option value="x-mac-japanese">x-mac-japanese</option>
				<option value="x-mac-korean">x-mac-korean</option>
				<option value="x-mac-roman-latin1">x-mac-roman-latin1</option>
				<option value="x-mac-romanian">x-mac-romanian</option>
				<option value="x-mac-simp-chinese">x-mac-simp-chinese</option>
				<option value="x-mac-symbol">x-mac-symbol</option>
				<option value="x-mac-thai">x-mac-thai</option>
				<option value="x-mac-tibetan">x-mac-tibetan</option>
				<option value="x-mac-trad-chinese">x-mac-trad-chinese</option>
				<option value="x-mac-turkish">x-mac-turkish</option>
				<option value="x-mac-ukranian">x-mac-ukranian</option>
				<option value="x-nextstep">x-nextstep</option>
			</select><label for="inputEncoding">Kodning</label><br>
			<select id="inputTimestamp" name="timestamp" required>
				<option value="NONE" selected>Tilføj ikke tidsstempel</option>
				<option value="YYYYMMDD">YYYYMMDD</option>
				<option value="YYYYMMDDHHNNSS">YYYYMMDDHHNNSS</option>
				<option value="YYYY-MM-DD">YYYY-MM-DD</option>
				<option value="DD-MM-YYYY">DD-MM-YYYY</option>
				<option value="MM-DD-YYYY">MM-DD-YYYY</option>
				<option value="YYYY-MM-DD-HHNNSS">YYYY-MM-DD-HHNNSS</option>
				<option value="YYYY-MM-DD-HHNNSSAM/PM">YYYY-MM-DD-HHNNSSAM/PM</option>
				<option value="YYYY-MM-DD-HH-NN-SS">YYYY-MM-DD-HH-NN-SS</option>
				<option value="YYYY-MM-DD HHNNSS">YYYY-MM-DD HHNNSS</option>
			</select><label for="inputTimestamp">Tidsstempel</label><br>
		</div>
		<div>
			<div style="column-count:3;">
				<div class="checkbox checked" onclick="modalCheckbox(this);"><input id="inputDataType" name="dataType" type="checkbox" value="1" checked><label for="inputDataType">Type</label></div><br>
				<div class="checkbox checked" onclick="modalCheckbox(this);"><input id="inputDataName" name="dataName" type="checkbox" value="1" checked><label for="inputDataName">Navn</label></div><br>
				<div class="checkbox checked" onclick="modalCheckbox(this);"><input id="inputDataName2" name="dataName2" type="checkbox" value="1" checked><label for="inputDataName2">Supplerende navneoplysninger</label></div><br>
				<div class="checkbox checked" onclick="modalCheckbox(this);"><input id="inputDataCvrNumber" name="dataCvrNumber" type="checkbox" value="1" checked><label for="inputDataCvrNumber">CVR-nummer</label></div><br>
				<div class="checkbox checked" onclick="modalCheckbox(this);"><input id="inputDataCprNumber" name="dataCprNumber" type="checkbox" value="1" checked><label for="inputDataCprNumber">CPR-nummer</label></div><br>
				<div class="checkbox checked" onclick="modalCheckbox(this);"><input id="inputDataAddress" name="dataAddress" type="checkbox" value="1" checked><label for="inputDataAddress">Adresse</label></div><br>
				<div class="checkbox checked" onclick="modalCheckbox(this);"><input id="inputDataAddress2" name="dataAddress2" type="checkbox" value="1" checked><label for="inputDataAddress2">Supplerende adresseoplysninger</label></div><br>
				<div class="checkbox checked" onclick="modalCheckbox(this);"><input id="inputDataZipCode" name="dataZipCode" type="checkbox" value="1" checked><label for="inputDataZipCode">Postnummer</label></div><br>
				<div class="checkbox checked" onclick="modalCheckbox(this);"><input id="inputDataCity" name="dataCity" type="checkbox" value="1" checked><label for="inputDataCity">By</label></div><br>
				<div class="checkbox checked" onclick="modalCheckbox(this);"><input id="inputDataCountry" name="dataCountry" type="checkbox" value="1" checked><label for="inputDataCountry">Land</label></div><br>
				<div class="checkbox checked" onclick="modalCheckbox(this);"><input id="inputDataPhone" name="dataPhone" type="checkbox" value="1" checked><label for="inputDataPhone">Telefon</label></div><br>
				<div class="checkbox checked" onclick="modalCheckbox(this);"><input id="inputDataPhone2" name="dataPhone2" type="checkbox" value="1" checked><label for="inputDataPhone2">Sekundær telefon</label></div><br>
				<div class="checkbox checked" onclick="modalCheckbox(this);"><input id="inputDataEmail" name="dataEmail" type="checkbox" value="1" checked><label for="inputDataEmail">E-mail</label></div><br>
				<div class="checkbox checked" onclick="modalCheckbox(this);"><input id="inputDataEmail2" name="dataEmail2" type="checkbox" value="1" checked><label for="inputDataEmail2">Sekundær e-mail</label></div><br>
				<div class="checkbox checked" onclick="modalCheckbox(this);"><input id="inputDataTags" name="dataTags" type="checkbox" value="1" checked><label for="inputDataTags">Mærker</label></div><br>
			</div>
		</div>
		<div>
			<select id="inputDateFormat" name="dateFormat" required autofocus>
				<option value="MDY">MDY</option>
				<option value="DMY" selected>DMY</option>
				<option value="YMD">YMD</option>
				<option value="YDM">YDM</option>
				<option value="DYM">DYM</option>
				<option value="MYD">MYD</option>
			</select><label for="inputDateFormat">Datoformat</label><br>
			<input id="inputDateDelimiter" list="inputDateDelimiterList" name="dateDelimiter" type="text" value="-" required><label for="inputDateDelimiter">Datoskilletegn</label><br>
			<datalist id="inputDateDelimiterList">
				<option value="-">
				<option value="/">
				<option value=".">
			</datalist>
			<input id="inputTimeDelimiter" list="inputTimeDelimiterList" name="timeDelimiter" type="text" value=":" required><label for="inputTimeDelimiter">Tidsskilletegn</label><br>
			<datalist id="inputTimeDelimiterList">
				<option value=":">
				<option value=".">
			</datalist>
			<input id="inputDecimalSymbol" list="inputDecimalSymbolList" name="decimalSymbol" type="text" value="," required><label for="inputDecimalSymbol">Decimalsymbol</label><br>
			<datalist id="inputDecimalSymbolList">
				<option value=".">
				<option value=",">
			</datalist>
		</div>
		<div>
			<select id="inputIncludeTitles" name="includeTitles" required autofocus>
				<option value="1" selected>Ja</option>
				<option value="0">Nej</option>
			</select><label for="inputIncludeTitles">Inkluder overskrifter</label><br>
			<select id="inputBlankIfZero" name="blankIfZero" required>
				<option value="1">Ja</option>
				<option value="0" selected>Nej</option>
			</select><label for="inputBlankIfZero">Blank hvis nul</label><br>
			<select id="inputRecordDelimiter" name="recordDelimiter" required>
				<option value="Automatic" selected>Automatisk</option>
				<option value="CR">CR</option>
				<option value="CRLF">CRLF</option>
				<option value="LF">LF</option>
			</select><label for="inputRecordDelimiter">Optegnelsesskilletegn</label><br>
			<input id="inputFieldDelimiter" list="inputFieldDelimiterList" name="fieldDelimiter" type="text" value="," required><label for="inputFieldDelimiter">Feltskilletegn</label><br>
			<datalist id="inputFieldDelimiterList">
				<option value="&#8677;">
				<option value=";">
				<option value=",">
				<option value=" ">
			</datalist>
			<input id="inputTextQualifier" list="inputTextQualifierList" name="textQualifier" type="text" value="&quot;"><label for="inputTextQualifier">Tekstkvalifikator</label><br>
			<datalist id="inputTextQualifierList">
				<option value="&quot;">
				<option value="'">
				<option value="`">
				<option value="~">
			</datalist>
		</div>
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Eksporter">
		</div>
	</form>
	<?php
	if(getSystemConfigurations('logFiles') == 1 || getSystemConfigurations('logFiles') == -1){
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
	if(getSystemConfigurations('logFiles') == 1 || getSystemConfigurations('logFiles') == -1){
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